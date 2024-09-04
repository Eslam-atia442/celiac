<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class RateResource extends BaseResource
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
        ];
        $this->full = [
            'rate' => $this->rate,
            'user' => $this->relationLoaded('user') ? new UserResource($this->whenLoaded('user')) : null,

        ];
        //$this->relationLoaded()
        $this->relations = [
        ];
        return $this->getResource();
    }
}
