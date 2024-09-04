<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class CommitteeResource extends BaseResource
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
            'name'        => $this->name,
            'description' => $this->description,
        ];

        $this->full = [
            'specialties_title' => $this->specialties_title,
            'specialties'       => $this->specialties,
            'tasks'             => $this->tasks,
            'is_active'         => $this->is_active,
            'active_class'      => $this->active_class,
            'active_status'     => $this->active_status,
        ];
        $this->relations = [
            'mainIcon' => $this->relationLoaded('mainIcon') ? new FileResource($this->whenLoaded('mainIcon')) : '',
            'icon'     => $this->relationLoaded('icon') ? new FileResource($this->whenLoaded('icon')) : '',
            'members'  => $this->relationLoaded('members') ? MemberResource::collection($this->whenLoaded('members')) : [],
        ];
        return $this->getResource();
    }
}
