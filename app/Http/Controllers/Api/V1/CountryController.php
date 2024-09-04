<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\CountryResource;
use Illuminate\Support\Facades\Request;
use App\Services\CountryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Lwwcas\LaravelCountries\Models\Country;

/**
 * @group Api
 * @subgroup Country
 */
class CountryController extends BaseApiController
{
    /**
     * CountryController constructor.
     * @param CountryService $service
     */


    public function __construct(CountryService $service)
    {
        $this->service = $service;
        parent::__construct($service, CountryResource::class);

    }

    public function index(): mixed
    {
        \request()->merge([
            'page' => 0,
            'limit' => 0,
            'scope' => 'micro'
        ]);
        return parent::index();
    }


}
