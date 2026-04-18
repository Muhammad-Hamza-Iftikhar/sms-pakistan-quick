<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use App\Services\BrevoService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SmsController extends Controller
{
    public function send(Request $request, BrevoService $brevoService): RedirectResponse
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

        $smsLog = SmsLog::create([
            'user_id' => $request->user()?->id,
            'recipient_phone' => $recipientForDb,
            'message' => $message,
            'provider' => 'brevo',
            'status' => 'pending',
        ]);

        try {
            $response = $brevoService->sendSms($recipient, $message);
            $payload = $this->extractProviderPayload($response);
            $providerMessageId = null;

            if (is_array($payload)) {
                $providerMessageId = $payload['messageId'] ?? $payload['message_id'] ?? null;
            }

            $smsLog->update([
                'status' => 'sent',
                'provider_message_id' => is_scalar($providerMessageId) ? (string) $providerMessageId : null,
                'provider_response' => $payload,
                'sent_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            $errorPayload = null;

            if ($exception instanceof RequestException && $exception->response) {
                $errorPayload = $this->extractProviderPayload($exception->response);
            }

            $smsLog->update([
                'status' => 'failed',
                'error_message' => mb_substr($exception->getMessage(), 0, 1000),
                'provider_response' => $errorPayload,
            ]);

            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'sms' => 'SMS could not be sent right now. Please try again.',
                ]);
        }

        return back()->with('sms_success', 'SMS sent successfully.');
    }

    private function extractProviderPayload(Response $response): array
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
}
