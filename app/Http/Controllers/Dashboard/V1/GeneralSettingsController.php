<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingRequest;
use App\Http\Resources\GeneralSettingsResource;
use App\Models\GeneralSettings;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\JsonResponse;

class GeneralSettingsController extends Controller
{
    use BaseApiResponseTrait;

    public function index(GeneralSettings $settings): JsonResponse
    {
       return $this->respondWithJson(new GeneralSettingsResource($settings));
    }

    public function update(GeneralSettings $settings, GeneralSettingRequest $request): JsonResponse
    {
        $settings->fill($request->validated());
        $settings->save();
        return $this->respondWithJson($settings);
    }
}
