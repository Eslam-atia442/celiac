<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutTheDiseaseSettingRequest;
use App\Http\Resources\AboutTheDiseaseSettingsResource;
use App\Models\AboutTheDiseaseSettings;
use App\Traits\BaseApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AboutTheDiseaseSettingsController extends Controller
{
    use BaseApiResponseTrait;

    public function index(AboutTheDiseaseSettings $settings): JsonResponse
    {
       return $this->respondWithJson(new AboutTheDiseaseSettingsResource($settings));
    }

    public function update(AboutTheDiseaseSettings $settings, AboutTheDiseaseSettingRequest $request): JsonResponse
    {
        $settings->fill($request->validated());
        $settings->save();
        return $this->respondWithJson($settings);
    }
}
