<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Models\Contact;
use App\Services\ContactService;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Contacts
 */

class ContactUsController extends BaseApiController
{
     /**
        * ContactController constructor.
        * @param ContactService $service
        */
       public function __construct(ContactService $service)
       {
           $this->service = $service;
           $this->middleware('permission:read-contact-us')->only(['index']);
           parent::__construct($service, ContactResource::class);

       }

    /**
     * Lists
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"ايمان محمود",
     *      "email" :"ahlamelhna@gmail.com",
     *  }
     * }
     */
    public function index(): mixed
    {
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Contacts Delete
     *
     * @urlParam $contact
     *
     * @response {
     *  "status": 200,
     *  "message": "",

     * }
     *
     */
    public function destroy(Contact $contact): JsonResponse
    {
        try {
            $this->service->remove($contact);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
