<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class DonationResource extends BaseResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'destination_name' => $this->destination_name,
            'description'      => $this->description,
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];

        $this->relations = [
            'image' => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : '',
            //            'donationType'=>  $this->relationLoaded('donationType')? new DonationTypeResource($this->whenLoaded('donationType')):'',
        ];

        return $this->getResource();
    }
}
