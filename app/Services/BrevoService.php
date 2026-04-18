<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrevoService
{
    protected string $apiKey;

    protected string $smsSender;

    public function __construct()
    {
        $this->apiKey = (string) config('services.brevo.api_key', '');
        $this->smsSender = (string) config('services.brevo.sms_sender', 'PakSMSConnect');
    }

    public function sendSms(string $phone, string $message): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Brevo API key is not configured.');
        }

        $phone = $this->normalizePhone($phone);

        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/transactionalSMS/sms', [
            'sender' => $this->smsSender,
            'recipient' => $phone,
            'content' => $message,
            'type' => 'transactional',
        ]);

        return $this->guardSmsResponse($response, $phone, $message);
    }

    private function normalizePhone(string $phone): string
    {
        $normalized = preg_replace('/[^0-9]/', '', $phone) ?: '';

        if (str_starts_with($normalized, '00')) {
            $normalized = substr($normalized, 2);
        }

        return ltrim($normalized, '+');
    }

    private function guardSmsResponse(Response $response, string $phone, string $message): Response
    {
        if ($response->successful()) {
            return $response;
        }

        Log::error('Brevo SMS request failed', [
            'status' => $response->status(),
            'response' => $response->body(),
            'recipient' => $phone,
            'sender' => $this->smsSender,
            'message_preview' => mb_substr($message, 0, 120),
        ]);

        $response->throw();

        return $response;
    }
}
