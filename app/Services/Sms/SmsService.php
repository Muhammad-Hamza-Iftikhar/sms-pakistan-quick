<?php

namespace App\Services\Sms;

class SmsService
{
    public function __construct(
        private readonly SmsProviderInterface $provider,
        private readonly string $providerName
    ) {
    }

    public function send(string $to, string $message, array $options = []): array
    {
        return $this->provider->send($to, $message, $options);
    }

    public function providerName(): string
    {
        return $this->providerName;
    }
}

