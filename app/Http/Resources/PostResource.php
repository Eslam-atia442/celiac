<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use \Illuminate\Http\Request;

class PostResource extends BaseResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            "publish_date" => $this->publish_date ? Carbon::parse($this->publish_date)->translatedFormat(config('app.date_format')) : '',
        ];
        $this->mini = [
            'description' => $this->description,
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status,
        ];
        $this->relations = [
            'user'  => $this->relationLoaded('user') ? new UserResource($this->whenLoaded('user')) : null,
            'image' => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : null,
        ];
        return $this->getResource();
    }
}
