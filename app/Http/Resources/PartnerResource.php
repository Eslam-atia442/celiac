<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class PartnerResource extends BaseResource
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
            'id'   => $this->id,
            'name' => $this->name,
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];

        $this->relations = [
            'image'        => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : '',
            'partnerGroup' => $this->relationLoaded('partnerGroup') ? new PartnerGroupResource($this->whenLoaded('partnerGroup')) : '',
        ];

        return $this->getResource();
    }
}
