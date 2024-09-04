<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Resources\ClinicSettingResource;
use Illuminate\Http\JsonResponse;
use App\Traits\BaseApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Http\Resources\AboutSettingResource;

/**
 * @group Api
 * @subgroup aboutTheDisease
 */
class AboutTheDiseaseController extends Controller
{
    use BaseApiResponseTrait;

    /**
     * aboutTheDisease
     *
     * @response {
     *  "text" :"text",
     *  "image":"image",
     * }
     *
     */
    public function index(): JsonResponse
    {
        $aboutSetting = (new SettingService())->getAboutSetting();
        return $this->respondWithJson(new AboutSettingResource($aboutSetting));
    }

    /**
     * About The Disease Setting
     *
     * @response {
     *  "text" :"text",
     *  "image" :"text",
     * }
     * @subgroup About The Disease Settings
     */
    public function getAboutTheDiseaseSetting(): JsonResponse
    {
        $setting = (new SettingService())->getClinicSetting();
        return $this->respondWithJson(new ClinicSettingResource($setting));
    }

}
