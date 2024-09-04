<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BooleanEnum;
use App\Enums\HealthLibraryTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\HealthLibraryResource;
use App\Services\HealthLibraryService;

/**
 * @group Api
 * @subgroup Translated Book
 */

class TranslatedBookController extends BaseApiController
{
    public string $type;
    public string $path;
    /**
     * TranslatedBookController constructor.
     * @param HealthLibraryService $service
     */

    public function __construct(HealthLibraryService $service)
    {
        $this->service = $service;
        $this->relations = ['image', 'file'];
        parent::__construct($service, HealthLibraryResource::class);
    }

    /**
     * List
     *
     * @queryParam filters[keyword] Filter by name, position.
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *      "description" :"",
     *   }
     * }
     *
     */
    public function index():mixed
    {
        \request()->merge(['page'=> false, 'limit'=> false, 'type' => HealthLibraryTypeEnum::translated_book->value, 'active'=> BooleanEnum::true?->value]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
