<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Celiac');
        $this->migrator->add('general.email', 'info@celiac.org.sa');
        $this->migrator->add('general.address', 'حي العليا _ شارع موسى بن نصير _ مبنى 9');
        $this->migrator->add('general.phone', '0559230381');
        $this->migrator->add('general.phone1', '0554885955');
        $this->migrator->add('general.facebook', 'http://www.facebook.com');
        $this->migrator->add('general.whatsapp', 'http://www.whatsapp.com');
        $this->migrator->add('general.youtube', 'https://www.youtube.com/channel/UCQhNpV4izIlG-mqau7pTfFg');
        $this->migrator->add('general.twitter', 'https://twitter.com/celiac_sa');
        $this->migrator->add('general.tiktok', 'https://www.tiktok.com/@celiac_sa');

//        $this->migrator->add('general.instagram', 'https://www.instagram.com/celiac_sa');
    }
};
