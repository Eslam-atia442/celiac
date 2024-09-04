<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class ClinicSettings extends Settings
{
    public string $bmi_link;
    public string $whatsapp_group;
    public string $telegram_group;
    public string $clinic_location;
    public string $clinic_email;

    public static function group(): string
    {
        return 'clinic';
    }

    public static function getSettingValue($key): string
    {
        return app(self::class)->$key;
    }
}
