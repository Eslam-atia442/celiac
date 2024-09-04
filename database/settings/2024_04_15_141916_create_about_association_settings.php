<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('about.board_of_directors_title_en',
            'أعضـــاء مجلس ادارة جمعية السليــاك'
        );
        $this->migrator->add('about.board_of_directors_title_ar',
            'أعضـــاء مجلس ادارة جمعية السليــاك'
        );
        $this->migrator->add('about.the_general_assembly_title_ar',
            'الهيكل التنظيمي لجمعية السلياك'
        );
        $this->migrator->add('about.the_general_assembly_title_en',
            'الهيكل التنظيمي لجمعية السلياك'
        );
        $this->migrator->add('about.the_organizational_structure_title_ar',
            'أعضاء الجمعيـــة العموميـــة'
        );
        $this->migrator->add('about.the_organizational_structure_title_en',
            'أعضاء الجمعيـــة العموميـــة'
        );


        $this->migrator->add('about.board_of_directors_description_en',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );
        $this->migrator->add('about.board_of_directors_description_ar',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );
        $this->migrator->add('about.the_general_assembly_description_ar',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );
        $this->migrator->add('about.the_general_assembly_description_en',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );
        $this->migrator->add('about.the_organizational_structure_description_ar',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );
        $this->migrator->add('about.the_organizational_structure_description_en',
            'نتشرف بعرض اعضاء الجمعية الكرام المساهمين فى جميع انجازات الجمعية بمختلف المجالات'
        );

    }
};
