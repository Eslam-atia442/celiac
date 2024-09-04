<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('about.board_of_directors_title_ar');
        $this->migrator->delete('about.board_of_directors_title_en');
        $this->migrator->delete('about.board_of_directors_description_en');
        $this->migrator->delete('about.board_of_directors_description_ar');


        $this->migrator->delete('about.the_general_assembly_title_ar');
        $this->migrator->delete('about.the_general_assembly_title_en');
        $this->migrator->delete('about.the_general_assembly_description_en');
        $this->migrator->delete('about.the_general_assembly_description_ar');


        $this->migrator->delete('about.the_organizational_structure_title_ar');
        $this->migrator->delete('about.the_organizational_structure_title_en');
        $this->migrator->delete('about.the_organizational_structure_description_en');
        $this->migrator->delete('about.the_organizational_structure_description_ar');
    }
};
