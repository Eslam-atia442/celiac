<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup News
 */

class NewsController extends BaseApiController
{
     /**
        * NewsController constructor.
        * @param NewsService $service
        */


       public function __construct(NewsService $service)
       {
           $this->service = $service;
           $this->relations = ['image'];
           parent::__construct($service, NewsResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param NewsRequest $request
     * @return JsonResponse
     */
    public function store(NewsRequest $request): JsonResponse
    {
        try {
            $news = $this->service->create($request->validated());
            return $this->respondWithModel($news->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param News $news
    * @return JsonResponse
    */
   public function show(News $news): JsonResponse
   {
       try {
           return $this->respondWithModel($news->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param News $news
     * @return JsonResponse
     */
    public function update(NewsRequest $request, News $news) : JsonResponse
    {
        try {
            $news = $this->service->update($news, $request->validated());
            return $this->respondWithModel($news->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news): JsonResponse
    {
        try {
            $this->service->remove($news);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param News $news
     * @return JsonResponse
     */
    public function changeActivation(News $news): JsonResponse
    {
        try {
            $this->service->toggleField($news, 'is_active');
            return $this->respondWithModel($news->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
