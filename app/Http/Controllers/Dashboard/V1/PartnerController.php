<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Services\PartnerService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Partner
 */
class PartnerController extends BaseApiController
{
    /**
     * PartnerController constructor.
     * @param PartnerService $service
     */
    public string $type;
    public string $path;

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
        $this->relations = ['image', 'partnerGroup'];
        $this->type = FileEnum::file_type_partner_image->value;
        $this->path = config('filesystems.upload.paths.partner');
        parent::__construct($service, PartnerResource::class, 'partner');
    }

    /**
     * Store a newly created resource in storage.
     * @param PartnerRequest $request
     * @return JsonResponse
     */
    public function store(PartnerRequest $request): JsonResponse
    {
        try {
            $partner = $this->service->createPartner($request->validated(), $this->type, $this->path);

            return $this->respondWithModel($partner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param Partner $partner
     * @return JsonResponse
     */
    public function show(Partner $partner): JsonResponse
    {
        try {
            return $this->respondWithModel($partner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartnerRequest $request
     * @param Partner $partner
     * @return JsonResponse
     */
    public function update(PartnerRequest $request, Partner $partner): JsonResponse
    {
        try {
            $partner = $this->service->updatePartner($partner, $request->validated(), $this->type, $this->path);

            return $this->respondWithModel($partner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Partner $partner
     * @return JsonResponse
     */
    public function destroy(Partner $partner): JsonResponse
    {
        try {
            $this->service->remove($partner);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Partner $partner
     * @return JsonResponse
     */
    public function changeActivation(Partner $partner): JsonResponse
    {
        try {
            $this->service->toggleField($partner, 'is_active');
            return $this->respondWithModel($partner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
