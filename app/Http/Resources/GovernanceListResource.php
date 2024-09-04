<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class GovernanceListResource extends BaseResource
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
            'files_count' => request()->has('withActiveFileCount') ? $this->active_files_count : 0,
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];

        $this->relations = [
            'files' => $this->relationLoaded('activeFiles') ? FileResource::collection($this->whenLoaded('activeFiles')) : [],
        ];
        return $this->getResource();
    }
}
