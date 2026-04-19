<?php

namespace App\Services\Sms\Providers;

use App\Services\Sms\SmsProviderInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LifetimeSmsProvider implements SmsProviderInterface
{
    public function send(string $to, string $message, array $options = []): array
    {
        $apiToken = (string) config('services.lifetimesms.api_token', '');
        $apiSecret = (string) config('services.lifetimesms.api_secret', '');
        $baseUrl = (string) config('services.lifetimesms.base_url', 'https://lifetimesms.com/plain');
        $from = (string) ($options['from'] ?? config('services.lifetimesms.from', 'Brand'));

        if ($apiToken === '' || $apiSecret === '') {
            Log::error('LifetimeSMS credentials are missing.', [
                'provider' => 'lifetime',
                'recipient' => $to,
            ]);

            return [
                'success' => false,
                'provider' => 'lifetime',
                'message_id' => null,
                'status' => null,
                'raw' => [],
                'error' => 'LifetimeSMS credentials are missing. Set LIFETIMESMS_API_TOKEN and LIFETIMESMS_API_SECRET.',
            ];
        }

        $payload = [
            'api_token' => $apiToken,
            'api_secret' => $apiSecret,
            'to' => $to,
            'from' => $from,
            'message' => $message,
        ];

        try {
            // Keep this request style identical to the verified working test route.
            $response = Http::asForm()
                ->timeout(30)
                ->withOptions(['verify' => false])
                ->post($baseUrl, $payload);

            $raw = $this->extractPayload($response);
            $success = $response->successful();
            $status = $this->extractStatus($raw, $response);
            $messageId = $this->extractMessageId($raw);
            $error = $success ? null : $this->extractErrorMessage($raw, $response->body());

            if (! $success) {
                Log::error('LifetimeSMS request failed', [
                    'provider' => 'lifetime',
                    'status' => $status,
                    'recipient' => $to,
                    'sender' => $from,
                    'message_preview' => mb_substr($message, 0, 120),
                    'error' => $error,
                ]);
            }

            return [
                'success' => $success,
                'provider' => 'lifetime',
                'message_id' => $messageId,
                'status' => $status,
                'raw' => $raw,
                'error' => $error,
            ];
        } catch (\Throwable $exception) {
            Log::error('LifetimeSMS request failed unexpectedly', [
                'provider' => 'lifetime',
                'recipient' => $to,
                'sender' => $from,
                'message_preview' => mb_substr($message, 0, 120),
                'error' => $exception->getMessage(),
            ]);

            return [
                'success' => false,
                'provider' => 'lifetime',
                'message_id' => null,
                'status' => null,
                'raw' => [],
                'error' => $exception->getMessage(),
            ];
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function extractPayload(Response $response): array
    {
        $decoded = $response->json();

        if (is_array($decoded)) {
            return $decoded;
        }

        return [
            'status' => $response->status(),
            'body' => $response->body(),
        ];
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractStatus(array $payload, Response $response): int|string|null
    {
        $status = $payload['status'] ?? $payload['code'] ?? null;

        if (is_scalar($status)) {
            return $status;
        }

        return $response->status();
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractMessageId(array $payload): ?string
    {
        $messageId = $payload['message_id']
            ?? $payload['msgid']
            ?? $payload['messageId']
            ?? $payload['id']
            ?? null;

        return is_scalar($messageId) ? (string) $messageId : null;
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractErrorMessage(array $payload, string $fallback): string
    {
        $error = $payload['err_msg']
            ?? $payload['error']
            ?? $payload['message']
            ?? $payload['description']
            ?? null;

        if (is_scalar($error) && trim((string) $error) !== '') {
            return (string) $error;
        }

        return trim($fallback) !== '' ? $fallback : 'LifetimeSMS request failed.';
    }
}
