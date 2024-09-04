<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Services\FaqService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Faq
 */

class FaqController extends BaseApiController
{
     /**
        * FaqController constructor.
        * @param FaqService $service
        */


       public function __construct(FaqService $service)
       {
           $this->service = $service;
           parent::__construct($service, FaqResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param FaqRequest $request
     * @return JsonResponse
     */
    public function store(FaqRequest $request): JsonResponse
    {
        try {
            $faq = $this->service->create($request->validated());
            return $this->respondWithModel($faq->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param Faq $faq
    * @return JsonResponse
    */
   public function show(Faq $faq): JsonResponse
   {
       try {
           return $this->respondWithModel($faq->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param FaqRequest $request
     * @param Faq $faq
     * @return JsonResponse
     */
    public function update(FaqRequest $request, Faq $faq) : JsonResponse
    {
        try {
            $faq = $this->service->update($faq, $request->validated());
            return $this->respondWithModel($faq->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param Faq $faq
     * @return JsonResponse
     */
    public function destroy(Faq $faq): JsonResponse
    {
        try {
            $this->service->remove($faq);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Faq $faq
     * @return JsonResponse
     */
    public function changeActivation(Faq $faq): JsonResponse
    {
        try {
            $this->service->toggleField($faq, 'is_active');
            return $this->respondWithModel($faq->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
