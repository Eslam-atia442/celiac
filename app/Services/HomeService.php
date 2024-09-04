<?php

namespace App\Services;

use App\Repositories\Contracts\BannerContract;
use App\Repositories\Contracts\DonationContract;
use App\Repositories\Contracts\DonationTypeContract;
use App\Repositories\Contracts\PartnerGroupContract;
use App\Repositories\Contracts\PostContract;
use App\Repositories\Contracts\SettingContract;

class HomeService
{
    public int $home_limit = 6;
    public function getHomeDetails(): array
    {
        request()->merge([ 'scope' =>'mini']);
        return [
            'banners' => $this->getBanners(),
            'donations' => $this->getDonations(),
            'posts' => $this->getPosts(),
            'about_settings' => $this->getAboutSettings(),
            'contact_settings' => $this->getGeneralSetting(),
            'partner_groups' => $this->getPartnerGroups(),
        ];
    }

    public function getBanners()
    {

        return app(BannerContract::class)->search([
            'active' => true,
        ], ['image'], ['page' => false, 'limit' => false, 'order'=> ['id' => 'desc']]);
    }

    public function getDonations()
    {
        return app(DonationContract::class)->search([
            'active' => true,
        ], ['image'], ['page' => false, 'limit' => $this->home_limit, 'order'=> ['id' => 'desc']]);
    }

    public function getPosts()
    {
        return app(PostContract::class)->search([
            'active' => true,
        ], ['image'], ['page' => false, 'limit' => $this->home_limit, 'order'=> ['id' => 'desc']]);
    }

    public function getAboutSettings(){
        return app(SettingContract::class)->getAboutSetting();
    }

    public function getGeneralSetting(){
        return app(SettingContract::class)->getGeneralSetting();
    }
    public function getPartnerGroups() {
        return app(PartnerGroupContract::class)->search([
            'active' => true,
        ], ['partners.image'], ['page' => false, 'limit' => false, 'order'=> ['id' => 'desc']]);
    }


}
