<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('about.association_about_description_en',
            'رفع مستوى الوعي, المساهمة في توفير بيئة صحية لمرضى السلياك, تعزيز ودعم الأبحاث العلمية والتطويرية, و دعم وتحفيز المشاريع الصغيرة في مجال السلياك',
        );

        $this->migrator->add('about.association_about_description_ar',
            'رفع مستوى الوعي, المساهمة في توفير بيئة صحية لمرضى السلياك, تعزيز ودعم الأبحاث العلمية والتطويرية, و دعم وتحفيز المشاريع الصغيرة في مجال السلياك',
        );

        $this->migrator->add('about.association_about_title_en',
            'تسعى الجمعية لتقديم خدمات وبرامج لجميع  المستفيدين ,كما تعزز الشراكات الناجحة لتلبية حاجات المجتمع',
        );
        $this->migrator->add('about.association_about_title_ar',
            'تسعى الجمعية لتقديم خدمات وبرامج لجميع  المستفيدين ,كما تعزز الشراكات الناجحة لتلبية حاجات المجتمع',
        );
    }
};
