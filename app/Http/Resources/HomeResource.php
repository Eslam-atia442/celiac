<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JBaseResource
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
            'id'      => $this->id,
            'name'    => $this->name,
            "banners" => []
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];
        $this->relations = [
//            'image' => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : null,
        ];
        return $this->getResource();
    }
}
