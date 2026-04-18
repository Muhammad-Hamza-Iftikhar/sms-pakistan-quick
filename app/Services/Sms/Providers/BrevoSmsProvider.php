<?php

namespace App\Services\Sms\Providers;

use App\Services\BrevoService;
use App\Services\Sms\SmsProviderInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class BrevoSmsProvider implements SmsProviderInterface
{
    public function __construct(
        private readonly BrevoService $brevoService
    ) {
    }

    public function send(string $to, string $message, array $options = []): array
    {
        try {
            $response = $this->brevoService->sendSms($to, $message);
            $raw = $this->extractPayload($response);

            return [
                'success' => true,
                'provider' => 'brevo',
                'message_id' => $this->extractMessageId($raw),
                'status' => $response->status(),
                'raw' => $raw,
            ];
        } catch (RequestException $exception) {
            $status = $exception->response?->status();
            $raw = $exception->response ? $this->extractPayload($exception->response) : [];
            $error = $this->extractErrorMessage($raw, $exception->getMessage());

            Log::error('Brevo provider request failed', [
                'provider' => 'brevo',
                'status' => $status,
                'recipient' => $to,
                'message_preview' => mb_substr($message, 0, 120),
                'error' => $error,
            ]);

            return [
                'success' => false,
                'provider' => 'brevo',
                'message_id' => $this->extractMessageId($raw),
                'status' => $status,
                'raw' => $raw,
                'error' => $error,
            ];
        } catch (\Throwable $exception) {
            Log::error('Brevo provider failed unexpectedly', [
                'provider' => 'brevo',
                'recipient' => $to,
                'message_preview' => mb_substr($message, 0, 120),
                'error' => $exception->getMessage(),
            ]);

            return [
                'success' => false,
                'provider' => 'brevo',
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
    private function extractMessageId(array $payload): ?string
    {
        $messageId = $payload['messageId'] ?? $payload['message_id'] ?? null;

        return is_scalar($messageId) ? (string) $messageId : null;
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractErrorMessage(array $payload, string $fallback): string
    {
        $error = $payload['message'] ?? $payload['error'] ?? null;

        if (is_scalar($error) && trim((string) $error) !== '') {
            return (string) $error;
        }

        return $fallback;
    }
}

