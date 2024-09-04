<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class AboutSettings extends Settings
{
    public string $association_about_title_ar;
    public string $association_about_title_en;
    public string $association_about_description_en;
    public string $association_about_description_ar;
    public string $association_visions_ar;
    public string $association_visions_en;
    public string $association_message_ar;
    public string $association_message_en;
    public string $association_objectives_ar;
    public string $association_objectives_en;
    public string $association_values_ar;
    public string $association_values_en;

    public string $establishment_of_the_association_en;
    public string $establishment_of_the_association_ar;
    public string $about_image;

    public static function group(): string
    {
        return 'about';
    }

    public static function getSettingValue($key): string
    {
        return app(self::class)->$key;
    }
}
