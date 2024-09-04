<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->micro = [
            'id'   => $this->id,
            'name' => $this->name,
        ];

        $this->mini = [
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        $this->full = [
            'is_active'     => (bool)$this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status,
            'can_delete'    => $this->can_delete,
        ];

        $this->relations = [
            'role'  => $this->relationLoaded('roles') ? ($this->roles)->first() : null,
            'image' => $this->relationLoaded('avatar') ? new FileResource($this->avatar) : null
        ];

        return $this->getResource();
    }
}
