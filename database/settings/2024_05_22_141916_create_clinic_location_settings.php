<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('clinic.clinic_location',
            'https://www.moh.gov.sa/HealthAwareness/MedicalTools/Pages/CalorieCalculate.aspx'
        );
        $this->migrator->add('clinic.clinic_email',
            'ahlamelhna@gmail.com'
        );
    }
};
