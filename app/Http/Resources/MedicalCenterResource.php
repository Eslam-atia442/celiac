<?php

namespace App\Http\Resources;


use App\Enums\MedicalCenterTypeEnum;
use \Illuminate\Http\Request;

class MedicalCenterResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->micro = [
            'id' => $this->id,
        ];
        $this->mini = [
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
        $this->full = [
            'type'        => $this->type,
            'type_text'   => MedicalCenterTypeEnum::getTitle($this->type),
            'author_name' => $this->author_name,
            'description' => $this->description,
            'title'       => $this->title,
            'video_url'   => $this->video_url,
            'video_type'  => $this->video_type,
            'image'       => $this->relationLoaded('image') ? FileResource::make($this->image) : null,
            'pdf'         => $this->relationLoaded('pdf') ? FileResource::make($this->pdf) : null,
        ];
        //$this->relationLoaded()
        $this->relations = [
        ];
        return $this->getResource();
    }
}
