<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class MailSetting extends Model
{
    protected $fillable = [
        'mailer', 'from_name', 'from_email', 'reply_to',
        'host', 'port', 'username', 'password', 'encryption', 'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'port'  => 'integer',
    ];

    public static function current(): ?self
    {
        return static::first();
    }

    public static function getOrCreate(): self
    {
        return static::firstOrCreate([], [
            'mailer'     => config('mail.default', 'smtp'),
            'from_name'  => config('mail.from.name', ''),
            'from_email' => config('mail.from.address', ''),
            'host'       => config('mail.mailers.smtp.host', ''),
            'port'       => config('mail.mailers.smtp.port', 587),
            'encryption' => config('mail.mailers.smtp.scheme', 'tls'),
            'actif'      => false,
        ]);
    }

    public function setPasswordAttribute(?string $value): void
    {
        if ($value && $value !== '••••••••') {
            $this->attributes['password'] = encrypt($value);
        }
    }

    public function getDecryptedPassword(): ?string
    {
        if (!$this->password) {
            return null;
        }
        try {
            return decrypt($this->password);
        } catch (\Exception) {
            return null;
        }
    }

    public function hasPassword(): bool
    {
        return !empty($this->password);
    }
}
