<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('about.association_about_en');
        $this->migrator->delete('about.association_about_ar');
    }
};
