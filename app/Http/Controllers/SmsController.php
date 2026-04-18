<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use App\Services\Sms\SmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SmsController extends Controller
{
    public function send(Request $request, SmsService $smsService): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'regex:/^3\d{9}$/'],
            'message' => ['required', 'string', 'max:500'],
        ], [
            'phone.regex' => 'Enter a valid PK mobile (e.g. 300 1234567).',
            'message.max' => 'Message must be under 500 characters.',
        ]);

        $message = trim($validated['message']);

        if ($message === '') {
            throw ValidationException::withMessages([
                'message' => 'Message cannot be empty.',
            ]);
        }

        $recipient = '92' . $validated['phone'];
        $recipientForDb = '+' . $recipient;
        $configuredProvider = $smsService->providerName();

        $smsLog = SmsLog::create([
            'user_id' => $request->user()?->id,
            'recipient_phone' => $recipientForDb,
            'message' => $message,
            'provider' => $configuredProvider,
            'status' => 'pending',
        ]);

        try {
            $result = $smsService->send($recipient, $message);
            $provider = $this->extractProviderName($result, $configuredProvider);

            if (($result['success'] ?? false) === true) {
                $smsLog->update([
                    'provider' => $provider,
                    'status' => 'sent',
                    'provider_message_id' => $this->extractMessageId($result),
                    'provider_response' => $result,
                    'sent_at' => now(),
                ]);

                return back()->with('sms_success', 'SMS sent successfully.');
            }

            $smsLog->update([
                'provider' => $provider,
                'status' => 'failed',
                'error_message' => mb_substr($this->extractErrorMessage($result), 0, 1000),
                'provider_response' => $result,
            ]);
        } catch (\Throwable $exception) {
            $smsLog->update([
                'status' => 'failed',
                'error_message' => mb_substr($exception->getMessage(), 0, 1000),
                'provider_response' => [
                    'success' => false,
                    'provider' => $configuredProvider,
                    'message_id' => null,
                    'status' => null,
                    'raw' => [],
                    'error' => $exception->getMessage(),
                ],
            ]);

            report($exception);
        }

        return back()
            ->withInput()
            ->withErrors([
                'sms' => 'SMS could not be sent right now. Please try again.',
            ]);
    }

    /**
     * @param array<string, mixed> $result
     */
    private function extractProviderName(array $result, string $fallback): string
    {
        $provider = $result['provider'] ?? null;

        return is_string($provider) && $provider !== '' ? $provider : $fallback;
    }

    /**
     * @param array<string, mixed> $result
     */
    private function extractMessageId(array $result): ?string
    {
        $messageId = $result['message_id'] ?? null;

        return is_scalar($messageId) ? (string) $messageId : null;
    }

    /**
     * @param array<string, mixed> $result
     */
    private function extractErrorMessage(array $result): string
    {
        $error = $result['error'] ?? null;

        if (is_scalar($error) && trim((string) $error) !== '') {
            return (string) $error;
        }

        $raw = $result['raw'] ?? null;

        if (is_array($raw)) {
            $nestedError = $this->findErrorInPayload($raw);

            if ($nestedError !== null) {
                return $nestedError;
            }
        }

        return 'SMS provider returned an error.';
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function findErrorInPayload(array $payload): ?string
    {
        $keys = ['err_msg', 'error', 'message', 'description'];

        foreach ($keys as $key) {
            $value = $payload[$key] ?? null;

            if (is_scalar($value) && trim((string) $value) !== '') {
                return (string) $value;
            }
        }

        $messages = $payload['messages'] ?? null;

        if (! is_array($messages)) {
            return null;
        }

        foreach ($messages as $messageItem) {
            if (! is_array($messageItem)) {
                continue;
            }

            $nested = $this->findErrorInPayload($messageItem);

            if ($nested !== null) {
                return $nested;
            }
        }

        return null;
    }
}
