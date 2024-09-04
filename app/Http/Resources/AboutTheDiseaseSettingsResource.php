<?php

namespace App\Http\Resources;

use App\Enums\FileEnum;
use App\Models\File;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AboutTheDiseaseSettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        $file = @File::where('type', FileEnum::file_type_about_diesease_image)->latest()->first();
        return [
            'text'  => $this->text,
            'image' => FileResource::make($file)
        ];
    }
}
