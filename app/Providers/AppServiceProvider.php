<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure application has an encryption key (Fixes MissingAppKeyException on live sites)
        if (!config('app.key') || empty(config('app.key'))) {
            config(['app.key' => 'base64:/aZvyvInK59QZuNrCtp0kMhTlF1wr/2LM9bBwYbQwKo=']);
        }

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');
                
                if (isset($settings['mail_host']) && !empty($settings['mail_host'])) {
                    config([
                        'mail.mailers.smtp.host' => $settings['mail_host'],
                        'mail.mailers.smtp.port' => $settings['mail_port'] ?? '587',
                        'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?? 'tls',
                        'mail.mailers.smtp.username' => $settings['mail_username'],
                        'mail.mailers.smtp.password' => $settings['mail_password'],
                        'mail.from.address' => $settings['mail_from_address'],
                        'mail.from.name' => $settings['site_name'] ?? 'Sanatan Raksha Sangh',
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Table might not exist during migration
        }
    }
}
