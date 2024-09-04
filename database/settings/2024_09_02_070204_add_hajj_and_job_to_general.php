<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.apply_for_hajj', true);
        $this->migrator->add('general.apply_for_jobs', true);
    }

    public function down()
    {
        $this->migrator->delete('general.apply_for_hajj');
        $this->migrator->delete('general.apply_for_jobs');
    }
};
