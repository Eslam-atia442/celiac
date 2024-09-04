<?php

namespace App\Services;

use App\Models\AboutSettings;
use App\Repositories\Contracts\SettingContract;

class SettingService
{
    /**
     * @return AboutSettings
     */
    public function getAboutSetting(): AboutSettings
    {
        return app(SettingContract::class)->getAboutSetting();
    }

    public function getGeneralSetting()
    {
        return app(SettingContract::class)->getGeneralSetting();
    }

    public function getClinicSetting()
    {
        return app(SettingContract::class)->getClinicSetting();
    }

    public function updateAboutSetting($requests)
    {
        return app(SettingContract::class)->updateAboutSetting($requests);
    }

    public function updateGeneralSetting($requests)
    {
        return app(SettingContract::class)->updateGeneralSetting($requests);
    }

    public function updateClinicSetting($requests)
    {
        return app(SettingContract::class)->updateClinicSetting($requests);
    }

    public function updateAboutTheDiseaseSetting($requests)
    {
        return app(SettingContract::class)->updateAboutTheDiseaseSetting($requests);
    }

    public function getAboutTheDiseaseSetting()
    {
        return app(SettingContract::class)->getAboutTheDiseaseSetting();
    }

    public function updateInformationAboutTreatmentSetting($requests)
    {
        return app(SettingContract::class)->updateInformationAboutTreatmentSetting($requests);
    }

    public function getInformationAboutTreatmentSetting()
    {
        return app(SettingContract::class)->getInformationAboutTreatmentSetting();
    }

}
