<?php

namespace App\Services\Sms\Providers;

use App\Services\Sms\SmsProviderInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MoceanSmsProvider implements SmsProviderInterface
{
    public function send(string $to, string $message, array $options = []): array
    {
        $apiToken = (string) config('services.mocean.api_token', '');
        $baseUrl = (string) config('services.mocean.base_url', 'https://rest.moceanapi.com');

        // Some providers only allow approved/whitelisted sender IDs.
        // Keep this override optional so transactional flows can pass a dedicated sender when needed.
        $sender = (string) ($options['from'] ?? config('services.mocean.sender_id', ''));

        if ($apiToken === '') {
            Log::error('Mocean SMS token is not configured.', [
                'provider' => 'mocean',
                'recipient' => $to,
            ]);

            return [
                'success' => false,
                'provider' => 'mocean',
                'message_id' => null,
                'status' => null,
                'raw' => [],
                'error' => 'Mocean API token is not configured.',
            ];
        }

        try {
            $response = Http::baseUrl(rtrim($baseUrl, '/'))
                ->acceptJson()
                ->asForm()
                ->withToken($apiToken)
                ->post('/rest/2/sms', [
                    'mocean-to' => $to,
                    'mocean-from' => $sender,
                    'mocean-text' => $message,
                    'mocean-resp-format' => 'json',
                ]);

            $raw = $this->extractPayload($response);
            $status = $this->extractStatus($raw, $response);
            $messageId = $this->extractMessageId($raw);
            $error = $this->extractErrorMessage($raw, $response->body());
            $success = $this->isSuccessfulResponse($response, $status, $error);

            if (! $success) {
                Log::error('Mocean SMS request failed', [
                    'provider' => 'mocean',
                    'status' => $status,
                    'recipient' => $to,
                    'sender' => $sender,
                    'message_preview' => mb_substr($message, 0, 120),
                    'error' => $error,
                ]);
            }

            return [
                'success' => $success,
                'provider' => 'mocean',
                'message_id' => $messageId,
                'status' => $status,
                'raw' => $raw,
                'error' => $success ? null : $error,
            ];
        } catch (RequestException $exception) {
            $status = $exception->response?->status();
            $raw = $exception->response ? $this->extractPayload($exception->response) : [];
            $error = $this->extractErrorMessage($raw, $exception->getMessage());

            Log::error('Mocean SMS request exception', [
                'provider' => 'mocean',
                'status' => $status,
                'recipient' => $to,
                'sender' => $sender,
                'message_preview' => mb_substr($message, 0, 120),
                'error' => $error,
            ]);

            return [
                'success' => false,
                'provider' => 'mocean',
                'message_id' => $this->extractMessageId($raw),
                'status' => $status,
                'raw' => $raw,
                'error' => $error,
            ];
        } catch (\Throwable $exception) {
            Log::error('Mocean SMS request failed unexpectedly', [
                'provider' => 'mocean',
                'recipient' => $to,
                'sender' => $sender,
                'message_preview' => mb_substr($message, 0, 120),
                'error' => $exception->getMessage(),
            ]);

            return [
                'success' => false,
                'provider' => 'mocean',
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
        $messages = $payload['messages'] ?? null;

        if (is_array($messages)) {
            $firstMessage = $messages[0] ?? null;

            if (is_array($firstMessage)) {
                $messageId = $firstMessage['msgid'] ?? $firstMessage['message_id'] ?? null;

                if (is_scalar($messageId)) {
                    return (string) $messageId;
                }
            }
        }

        $messageId = $payload['msgid'] ?? $payload['message_id'] ?? null;

        return is_scalar($messageId) ? (string) $messageId : null;
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractStatus(array $payload, Response $response): int|string|null
    {
        $messages = $payload['messages'] ?? null;

        if (is_array($messages)) {
            $firstMessage = $messages[0] ?? null;

            if (is_array($firstMessage)) {
                $status = $firstMessage['status'] ?? null;

                if (is_scalar($status)) {
                    return $status;
                }
            }
        }

        $status = $payload['status'] ?? null;

        if (is_scalar($status)) {
            return $status;
        }

        return $response->status();
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function extractErrorMessage(array $payload, string $fallback): string
    {
        $messages = $payload['messages'] ?? null;

        if (is_array($messages)) {
            $firstMessage = $messages[0] ?? null;

            if (is_array($firstMessage)) {
                $error = $firstMessage['err_msg']
                    ?? $firstMessage['error']
                    ?? $firstMessage['message']
                    ?? null;

                if (is_scalar($error) && trim((string) $error) !== '') {
                    return (string) $error;
                }
            }
        }

        $error = $payload['err_msg'] ?? $payload['error'] ?? $payload['message'] ?? null;

        if (is_scalar($error) && trim((string) $error) !== '') {
            return (string) $error;
        }

        return trim($fallback) !== '' ? $fallback : 'Mocean request failed.';
    }

    private function isSuccessfulResponse(Response $response, int|string|null $status, string $error): bool
    {
        if (! $response->successful()) {
            return false;
        }

        if (is_numeric($status)) {
            return (int) $status === 0;
        }

        if (is_string($status) && trim($status) !== '') {
            return in_array(strtolower(trim($status)), ['0', 'ok', 'success'], true);
        }

        return trim($error) === '' || strtolower(trim($error)) === 'success';
    }
}

