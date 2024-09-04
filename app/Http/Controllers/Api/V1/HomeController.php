<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\AboutSettingResource;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationTypeResource;
use App\Http\Resources\GeneralSettingResource;
use App\Http\Resources\PartnerGroupResource;
use App\Http\Resources\PostResource;
use App\Models\AboutSettings;
use App\Models\GeneralSettings;
use App\Services\HomeService;
use App\Traits\BaseApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use Illuminate\Http\JsonResponse;


/**
 * @group Api
 * @subgroup Home Page Endpoints
 */

class HomeController extends Controller
{

    use BaseApiResponseTrait;
       public function __construct(HomeService $service)
       {
           $this->service = $service;
       }
    /**
     * Home Page
     * @response {
     *  "status": 200,
     *  "data":{
     *     "banners": [],
     *     "donation_types": [],
     *     "contact_settings": [],
     *     "about_settings": [],
     *     "posts": [],
     *  }
     * }
     */

        public function index(): mixed
        {
          $data = $this->service->getHomeDetails();
          return $this->respondWithArray([
              'banners'=> BannerResource::collection($data['banners']??[]),
              'donations'=> DonationResource::collection($data['donations']??[]),
              'posts'=> PostResource::collection($data['posts']??[]),
              'about_settings'=> new AboutSettingResource($data['about_settings']),
              'contact_settings'=> new GeneralSettingResource($data['contact_settings']),
              'partner_groups'=> PartnerGroupResource::collection($data['partner_groups']),
          ]);
        }


    /**
     * System Version
     * @response {
     * "version":"1.1.2"
     * }
     */
        public function versionValue():JsonResponse
        {
            return $this->respondWithJson(['version'=>config('app.version')]);
        }

}
