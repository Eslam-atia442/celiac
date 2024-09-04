<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('informationAboutTreatment.text',
            'text'
        );
        $this->migrator->add('informationAboutTreatment.photo',
            'image'
        );
    }

    public function down()
    {
        $this->migrator->delete('informationAboutTreatment.text');
        $this->migrator->delete('informationAboutTreatment.photo');
    }
};
