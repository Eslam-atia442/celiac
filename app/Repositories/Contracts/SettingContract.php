<?php

namespace App\Repositories\Contracts;

interface SettingContract
{
    public function getAboutSetting();
    public function getGeneralSetting();
    public function getClinicSetting();
    public function updateAboutSetting($requests);
    public function updateGeneralSetting($requests);
    public function updateClinicSetting($requests);
    public function updateAboutTheDiseaseSetting($requests);
    public function getAboutTheDiseaseSetting();
    public function updateInformationAboutTreatmentSetting($requests);
    public function getInformationAboutTreatmentSetting();

}

