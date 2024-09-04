<?php

namespace App\Http\Controllers\Dashboard\V1;

use AllowDynamicProperties;
use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\DonationRequest;
use App\Http\Resources\DonationResource;
use App\Models\Donation;
use App\Services\DonationService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Donation
 */
class DonationController extends BaseApiController
{
    /**
     * DonationController constructor.
     * @param  DonationService  $service
     */

    public string $type;
    public string $path;

    public function __construct(DonationService $service)
    {
        $this->service = $service;
        $this->relations = ['image'];
        $this->type = FileEnum::file_type_donation_image->value;
        $this->path = config('filesystems.upload.paths.file_type_donation_image');
        parent::__construct($service, DonationResource::class, 'donation');
    }

    /**
     * Store a newly created resource in storage.
     * @param  DonationRequest  $request
     * @return JsonResponse
     */
    public function store(DonationRequest $request): JsonResponse
    {
        try {
            $donation = $this->service->createDonation($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($donation);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param  Donation  $donation
     * @return JsonResponse
     */
    public function show(Donation $donation): JsonResponse
    {
        try {
            return $this->respondWithModel($donation->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DonationRequest  $request
     * @param  Donation  $donation
     * @return JsonResponse
     */
    public function update(DonationRequest $request, Donation $donation): JsonResponse
    {
        try {
            $donation = $this->service->updateDonation($donation, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($donation);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  Donation  $donation
     * @return JsonResponse
     */
    public function destroy(Donation $donation): JsonResponse
    {
        try {
            $this->service->remove($donation);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param  Donation  $donation
     * @return JsonResponse
     */
    public function changeActivation(Donation $donation): JsonResponse
    {
        try {
            $this->service->toggleField($donation, 'is_active');
            return $this->respondWithModel($donation->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
