<?php

namespace App\Services\Sms;

interface SmsProviderInterface
{
    /**
     * Send an SMS message.
     *
     * @return array{
     *     success: bool,
     *     provider: string,
     *     message_id: string|null,
     *     status: int|string|null,
     *     raw: array<string, mixed>,
     *     error?: string|null
     * }
     */
    public function send(string $to, string $message, array $options = []): array;
}

