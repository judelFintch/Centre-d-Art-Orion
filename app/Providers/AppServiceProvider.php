<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->applyMailConfig();
    }

    private function applyMailConfig(): void
    {
        try {
            $setting = \App\Models\MailSetting::current();

            if (!$setting || !$setting->actif) {
                return;
            }

            Config::set('mail.default', $setting->mailer);
            Config::set('mail.from.address', $setting->from_email);
            Config::set('mail.from.name', $setting->from_name);

            if ($setting->reply_to) {
                Config::set('mail.reply_to.address', $setting->reply_to);
            }

            if ($setting->mailer === 'smtp') {
                Config::set('mail.mailers.smtp.host',     $setting->host);
                Config::set('mail.mailers.smtp.port',     $setting->port);
                Config::set('mail.mailers.smtp.username', $setting->username);
                Config::set('mail.mailers.smtp.password', $setting->getDecryptedPassword());
                Config::set('mail.mailers.smtp.scheme',   $setting->encryption);
            }
        } catch (\Throwable) {
            // Table absente (première migration) — on ne fait rien
        }
    }
}
