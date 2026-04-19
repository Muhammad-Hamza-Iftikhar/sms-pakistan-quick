<?php

namespace App\Providers;

use App\Services\Sms\Providers\BrevoSmsProvider;
use App\Services\Sms\Providers\LifetimeSmsProvider;
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
                'lifetime' => $app->make(LifetimeSmsProvider::class),
                'mocean' => $app->make(MoceanSmsProvider::class),
                'brevo' => $app->make(BrevoSmsProvider::class),
                default => $app->make(LifetimeSmsProvider::class),
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
        $provider = strtolower((string) config('services.sms.default_provider', config('sms.default', 'lifetime')));

        if ($provider === 'lifetimesms') {
            return 'lifetime';
        }

        return in_array($provider, ['lifetime', 'brevo', 'mocean'], true) ? $provider : 'lifetime';
    }
}
