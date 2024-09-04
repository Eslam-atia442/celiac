<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('aboutTheDisease.text',
            'text'
        );
        $this->migrator->add('aboutTheDisease.photo',
            'image'
        );
    }

    public function down()
    {
        $this->migrator->delete('aboutTheDisease.text');
        $this->migrator->delete('aboutTheDisease.photo');
    }
};
