<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class BannerResource extends BaseResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'is_redirect' => $this->is_redirect,
            'url'         => $this->url
        ];
        $this->mini = [
            'is_redirect' => $this->is_redirect,
            'description' => $this->description,
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];
        $this->relations = [
            'image' => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : null,
        ];
        return $this->getResource();
    }
}
