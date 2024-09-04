<?php

namespace App\Models;

use App\Enums\FileEnum;
use Spatie\LaravelSettings\Settings;

class InformationAboutTreatmentSettings extends Settings
{
    public string $text;
    public string $photo;

    public static function group(): string
    {
        return 'InformationAboutTreatment';
    }
    public static function getSettingValue($key): string
    {
        return app(self::class)->$key;
    }

}
