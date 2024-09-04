<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('clinic.bmi_link',
            'https://www.moh.gov.sa/HealthAwareness/MedicalTools/Pages/CalorieCalculate.aspx'
        );
        $this->migrator->add('clinic.whatsapp_group',
            'https://web.whatsapp.com'
        );
        $this->migrator->add('clinic.telegram_group',
            'https://web.telegram.org'
        );
    }
};
