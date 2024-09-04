<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RoleResource extends BaseResource
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

        $this->mini = [
            'users_count' => request()->has('withUsersCount') ? $this->users_count : 0,
        ];

        $this->full = [
            'can_be_deleted' => $this->can_be_deleted,
            'is_active'      => $this->is_active,
            'created_at'     => $this->created_at->format(config('app.date_format')),
        ];

        $this->relations = [
            'permissions'      => $this->relationLoaded('permissions') ? $this->whenLoaded('permissions', function () {
                return $this->permissions->isNotEmpty() ? $this->customizePermissions('name') : (object)null;
            }) : [],
            'role_permissions' => $this->relationLoaded('permissions') ? $this->whenLoaded('permissions', function () {
                return $this->permissions->isNotEmpty() ? $this->customizePermissions('id') : (object)null;
            }) : [],
            'users'            => $this->relationLoaded('users') ? UserResource::collection($this->whenLoaded('users')) : [],
        ];
        return $this->getResource();
    }

    private function customizePermissions($field)
    {
        return $this->permissions->groupBy('model')->map(function ($model, $key) use ($field) {
            return $model->pluck($field);
        })->collect();
    }
}
