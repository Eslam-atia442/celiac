<?php

namespace App\Http\Controllers\Dashboard\V1;



use App\Http\Controllers\Controller;
use App\Http\Requests\AboutSettingRequest;
use App\Http\Requests\AboutTheDiseaseSettingRequest;
use App\Http\Requests\ClinicSettingRequest;
use App\Http\Requests\GeneralSettingRequest;
use App\Http\Requests\InformationAboutTreatmentSettingRequest;
use App\Http\Resources\AboutTheDiseaseSettingsResource;
use App\Http\Resources\ClinicSettingResource;
use App\Http\Resources\GeneralSettingResource;
use App\Http\Resources\InformationAboutTreatmentSettingsResource;
use App\Services\SettingService;

use App\Http\Resources\AboutSettingResource;use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Settings
 */

class SettingController extends Controller
{

    use BaseApiResponseTrait;

    /**
     * About Setting List
     *
     * @response {
     *  "association_about" :"association_about",
     *  "establishment_of_the_association":"establishment_of_the_association",
     * }
     *
     */
    public function index(): JsonResponse
    {
        return $this->respondWithJson(new AboutSettingResource((new SettingService())->getAboutSetting()));
    }

    /**
     * General Setting List
     *
     * @response {
     *  "email" :"ahlamelhna@gmail.com",
     *  "address":"",
     * }
     *
     */
    public function getGeneralSettings(): JsonResponse
    {
        return $this->respondWithJson(new GeneralSettingResource((new SettingService())->getGeneralSetting()));
    }
    /**
     * Clinic Setting List
     *
     * @response {
     *   "bmi_link" :"https://www.moh.gov.sa/HealthAwareness/MedicalTools/Pages/CalorieCalculate.aspx",
     *   "whatsapp_group" :"",
     *   "telegram_group" :"",
     * }
     * @subgroup Clinic Settings
     */
    public function getClinicSettings():JsonResponse
    {
        $setting  = (new SettingService())->getClinicSetting();
        return $this->respondWithJson(new ClinicSettingResource($setting));
    }



    /**
     * About The Disease Setting List
     *
     * @response {
     *   "text" :"text",
     *   "image" :"image",
     * }
     * @subgroup about The Disease Settings
     */



    public function getAboutTheDiseaseSettings():JsonResponse
    {
        $setting  = (new SettingService())->getAboutTheDiseaseSetting();
        return $this->respondWithJson(new AboutTheDiseaseSettingsResource($setting));
    }

    /**
     * About information about treatment Setting
     *
     * @response {
     *   "text" :"text",
     *   "image" :"image",
     * }
     * @subgroup information about treatment
     */



    public function getInformationAboutTreatment():JsonResponse
    {
        $setting  = (new SettingService())->getInformationAboutTreatmentSetting();
        return $this->respondWithJson(new InformationAboutTreatmentSettingsResource($setting));
    }

    /**
     * Update  information about treatment Setting
     *
     * @bodyParam text text required
     * @bodyParam image file required
     *
     *
     * @response {
     *  "text" :"text",
     *  "file":"file",
     * }
     * @subgroup information about treatment
     */
    public function updateInformationAboutTreatment(InformationAboutTreatmentSettingRequest $request): JsonResponse
    {
        $aboutSetting = (new SettingService())->updateInformationAboutTreatmentSetting($request->validated());
        return $this->respondWithJson(new AboutTheDiseaseSettingsResource($aboutSetting));
    }

    /**
     * Update About The Disease Setting
     *
     * @bodyParam text text required
     * @bodyParam image file required
     *
     *
     * @response {
     *  "text" :"text",
     *  "file":"file",
     * }
     * @subgroup about The Disease Settings
     */
    public function updateAboutTheDiseaseSettings(AboutTheDiseaseSettingRequest $request): JsonResponse
    {
        $aboutSetting = (new SettingService())->updateAboutTheDiseaseSetting($request->validated());
        return $this->respondWithJson(new AboutTheDiseaseSettingsResource($aboutSetting));
    }





    /**
     * Update About Setting
     *
     * @bodyParam association_about_title text required
     * @bodyParam association_about_description text required
     * @bodyParam establishment_of_the_association text required
     * @bodyParam association_visions text required
     * @bodyParam association_message text required
     * @bodyParam association_objectives text required
     * @bodyParam association_values text required
     *
     *
     * @response {
     *  "association_about" :"association_about",
     *  "establishment_of_the_association":"establishment_of_the_association",
     * }
     *
     */
    public function update(AboutSettingRequest $request): JsonResponse
    {
        $aboutSetting = (new SettingService())->updateAboutSetting($request->validated());
        return $this->respondWithJson(new AboutSettingResource($aboutSetting));
    }



    /**
     * Update General Setting
     *
     * @bodyParam email text required
     * @bodyParam address text required
     * @bodyParam phone text required
     * @bodyParam phone1 text required
     * @bodyParam tiktok text required
     * @bodyParam twitter text required
     * @bodyParam youtube text required
     * @bodyParam whatsapp text required
     * @bodyParam facebook text required
     *
     *
     * @response {
     *  "email" :"ahlamelhna@gmail.com",
     *  "address":"",
     * }
     *
     */
    public function updateGeneralSettings(GeneralSettingRequest $request): JsonResponse
    {
        $generalSetting = (new SettingService())->updateGeneralSetting($request->validated());
        return $this->respondWithJson(new GeneralSettingResource($generalSetting));
    }


    /**
     * Update Clinic Setting
     *
     * @bodyParam bmi_link text required [link]
     * @bodyParam whatsapp_group text required [link]
     * @bodyParam telegram_group text required [link]
     * @bodyParam clinic_location text required [link]
     * @bodyParam clinic_email text required [email]
     *
     *
     * @response {
     *  "bmi_link" :"https://www.moh.gov.sa/HealthAwareness/MedicalTools/Pages/CalorieCalculate.aspx",
     *  "whatsapp_group" :"",
     *  "telegram_group" :"",
     * }
     * @subgroup Clinic Settings
     */
    public function updateClinicSettings(ClinicSettingRequest $request): JsonResponse
    {
        $setting = (new SettingService())->updateClinicSetting($request->validated());
        return $this->respondWithJson(new ClinicSettingResource($setting));
    }

}
