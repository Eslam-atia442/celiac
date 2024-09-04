<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\CeliacCardStatusEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\CeliacCardRequest;
use App\Http\Resources\CeliacCardResource;
use App\Models\CeliacCard;
use App\Services\CeliacCardService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup CeliacCard
 */
class CeliacCardController extends BaseApiController
{
    /**
     * CeliacCardController constructor.
     * @param CeliacCardService $service
     */


    public function __construct(CeliacCardService $service)
    {
        $this->service = $service;
        $this->relations = ['user','medicalReport'];
        parent::__construct($service, CeliacCardResource::class);
    }


    /**
     * Display a listing of card request
     *
     *
     */
    public function index(): mixed
    {
        request()->merge([ 'statusSearch' => CeliacCardStatusEnum::pending->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Display a listing of card owners
     *
     *
     */

    public function cardOwners()
    {
        request()->merge([ 'statusSearch' => CeliacCardStatusEnum::accepted->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Store a newly created resource in storage.
     * @param CeliacCardRequest $request
     * @return JsonResponse
     */
    public function store(CeliacCardRequest $request): JsonResponse
    {
        try {
            $celiacCard = $this->service->create($request->validated());
            return $this->respondWithModel($celiacCard->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param CeliacCard $celiacCard
     * @return JsonResponse
     */
    public function show(CeliacCard $celiacCard): JsonResponse
    {
        try {
            return $this->respondWithModel($celiacCard->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CeliacCardRequest $request
     * @param CeliacCard $celiacCard
     * @return JsonResponse
     */
    public function update(CeliacCardRequest $request, CeliacCard $celiacCard): JsonResponse
    {
        try {
            $celiacCard = $this->service->update($celiacCard, $request->validated());
            return $this->respondWithModel($celiacCard->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param CeliacCard $celiacCard
     * @return JsonResponse
     */
    public function destroy(CeliacCard $celiacCard): JsonResponse
    {
        try {
            $this->service->remove($celiacCard);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param CeliacCard $celiacCard
     * @return JsonResponse
     */
    public function changeActivation(CeliacCard $celiacCard): JsonResponse
    {
        try {
            $this->service->toggleField($celiacCard, 'is_active');
            return $this->respondWithModel($celiacCard->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
