<?php

namespace App\Http\Controllers\Api\V1;


use Exception;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Contact
 */

class ContactController extends BaseApiController
{
     /**
        * ContactController constructor.
        * @param ContactService $service
        */
       public function __construct(ContactService $service)
       {
           $this->service = $service;
           parent::__construct($service, ContactResource::class);
       }

    /**
     * Contact Us
     *
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam phone number required
     * @bodyParam country_code number required
     * @bodyParam message string required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name":"eman mahmoud",
     *      "phone":01011279823,
     *      "message":"test message",
     *  }
     * }
     */
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $contact = $this->service->create($request->validated());
            return $this->respondWithModel($contact->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
