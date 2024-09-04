<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $email;
    public string $address;
    public string $phone;
    public string $phone1;
    public string $tiktok;
    public string $twitter;
    public string $youtube;
    public string $whatsapp;
    public string $facebook;
    public bool $apply_for_hajj;
    public bool $apply_for_jobs;

    const PERMISSIONS_NOT_APPLIED = true;

    public static function group(): string
    {
        return 'general';
    }

    public static function getSettingValue($key): string
    {
        return app(self::class)->$key;
    }

}
