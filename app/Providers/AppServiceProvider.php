<?php

namespace App\Providers;

use App\Services\Sms\Providers\BrevoSmsProvider;
use App\Services\Sms\Providers\MoceanSmsProvider;
use App\Services\Sms\SmsProviderInterface;
use App\Services\Sms\SmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SmsProviderInterface::class, function ($app) {
            return match ($this->resolveSmsProviderName()) {
                'mocean' => $app->make(MoceanSmsProvider::class),
                'brevo' => $app->make(BrevoSmsProvider::class),
                default => $app->make(BrevoSmsProvider::class),
            };
        });

        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService(
                $app->make(SmsProviderInterface::class),
                $this->resolveSmsProviderName()
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function resolveSmsProviderName(): string
    {
        $provider = (string) config('services.sms.default_provider', config('sms.default', 'mocean'));

        return in_array($provider, ['brevo', 'mocean'], true) ? $provider : 'brevo';
    }
}
