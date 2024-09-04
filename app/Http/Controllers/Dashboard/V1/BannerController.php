<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Services\BannerService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Dashboard
 * @subgroup Banner
 */
class BannerController extends BaseApiController
{
    /**
     * BannerController constructor.
     * @param BannerService $service
     */

    public string $type;
    public string $path;


    public function __construct(BannerService $service)
    {
        $this->service = $service;
        $this->relations = ['image'];
        $this->type = FileEnum::file_type_banner_image->value;
        $this->path = config('filesystems.upload.paths.file_type_banner_image');

        parent::__construct($service, BannerResource::class, 'banner');
    }

    /**
     * Store a newly created resource in storage.
     * @param BannerRequest $request
     * @return JsonResponse
     */
    public function store(BannerRequest $request): JsonResponse
    {
        try {
            $banner = $this->service->createBanner($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($banner);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param Banner $banner
     * @return JsonResponse
     */
    public function show(Banner $banner): JsonResponse
    {
        try {
            return $this->respondWithModel($banner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerRequest $request
     * @param Banner $banner
     * @return JsonResponse
     */
    public function update(BannerRequest $request, Banner $banner): JsonResponse
    {
         try {
            $banner = $this->service->updateBanner($banner, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($banner);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Banner $banner
     * @return JsonResponse
     */
    public function destroy(Banner $banner): JsonResponse
    {
        try {
            $this->service->remove($banner);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Banner $banner
     * @return JsonResponse
     */
    public function changeActivation(Banner $banner): JsonResponse
    {
        try {
            $this->service->toggleField($banner, 'is_active');
            return $this->respondWithModel($banner->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
