<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BooleanEnum;
use App\Enums\FileEnum;
use App\Enums\HealthLibraryTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\FaqResource;
use App\Http\Resources\HealthLibraryResource;
use App\Services\FaqService;
use App\Services\HealthLibraryService;

/**
 * @group Api
 * @subgroup (FAQ) Frequently Asked Questions
 */
class FaqController extends BaseApiController
{

    /**
     *  Faq constructor.
     * @param FaqService $service
     */

    public function __construct(FaqService $service)
    {
        $this->service = $service;
        parent::__construct($service, FaqResource::class);

    }

    /**
     * List
     *
     * @queryParam filters[keyword] Filter by question, answer.
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "question" :"question",
     *      "answer" :"answer",
     *   }
     * }
     *
     */
    public function index(): mixed
    {
//        \request()->merge(['page' => false, 'limit' => false, 'type' => HealthLibraryTypeEnum::guidance_manual->value, 'active' => BooleanEnum::true?->value]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
