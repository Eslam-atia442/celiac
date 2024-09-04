<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Resources\AboutTheDiseaseSettingsResource;
use App\Http\Resources\ClinicSettingResource;
use App\Http\Resources\InformationAboutTreatmentSettingsResource;
use Illuminate\Http\JsonResponse;
use App\Traits\BaseApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Http\Resources\AboutSettingResource;

/**
 * @group Api
 * @subgroup About
 */
class AboutController extends Controller
{
    use BaseApiResponseTrait;

    /**
     * About
     *
     * @response {
     *  "association_about" :"association_about",
     *  "establishment_of_the_association":"establishment_of_the_association",
     * }
     *
     */
    public function index(): JsonResponse
    {
        $aboutSetting = (new SettingService())->getAboutSetting();
        return $this->respondWithJson(new AboutSettingResource($aboutSetting));
    }

    /**
     * Clinic Setting
     *
     * @response {
     *  "bmi_link" :"https://www.moh.gov.sa/HealthAwareness/MedicalTools/Pages/CalorieCalculate.aspx ",
     * }
     * @subgroup Clinic Settings
     */
    public function getClinicSetting(): JsonResponse
    {
        $setting = (new SettingService())->getClinicSetting();
        return $this->respondWithJson(new ClinicSettingResource($setting));
    }

    /**
     * About The Disease Setting
     *
     *
     * @subgroup About The Disease Setting
     */
    public function getAboutDisease(): JsonResponse
    {
        $setting = (new SettingService())->getAboutTheDiseaseSetting();
        return $this->respondWithJson(new AboutTheDiseaseSettingsResource($setting));
    }

    /**
     * Information About Treatment
     *
     *
     * @subgroup Information About Treatment
     */

    public function getInformationAboutTreatment(): JsonResponse
    {
        $setting = (new SettingService())->getInformationAboutTreatmentSetting();
        return $this->respondWithJson(new InformationAboutTreatmentSettingsResource($setting));
    }

}
