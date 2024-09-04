<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UserResource extends BaseResource
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
            'id'              => $this->id,
            'accessToken'     => $this->accessToken ?? null,
            'fullAccessToken' => @$this->tokens->last() ? UserTokenResource::make($this->tokens->last()) : null,
            'name'            => $this->name,
        ];

        $this->mini = [
            'email'       => $this->email,
            'phone'       => $this->phone,
            'last_update' => $this->updated_at->diffForHumans(),
        ];

        $this->full = [

            'is_active'          => (bool)$this->is_active,
            'active_class'       => $this->active_class,
            'active_status'      => $this->active_status,
            'code_for_test_only' => config('app.env') == 'local' ? $this->code_for_test_only : null,
            'user_resident_type' => $this->user_resident_type,
            'civil_id'           => $this->civil_id,
            'residency_number'   => $this->residency_number,
            'birthdate'          => $this->birthdate,
            'age'                => $this->age,
        ];
        $this->relations = [
            'roles'       => $this->relationLoaded('roles') ? implode(' ,', $this->getRoleNames()->toArray()) : '',
            'roles_ids'   => $this->relationLoaded('roles') ? $this->getRoleIds() : [],
            'role_id'     => $this->relationLoaded('roles') ? $this->getRoleIds()[0] ?? null : null,
            'permissions' => $this->relationLoaded('permissions') ? PermissionResource::collection($this->getAllPermissions()) : null,
            'avatar'      => $this->relationLoaded('avatar') ? new FileResource($this->avatar) : null
        ];

        return $this->getResource();
    }

    public function getRoleIds()
    {
        return $this->whenLoaded('roles', function () {
            return $this->roles->sortByDesc('id')->pluck('id')->toArray();
        });
    }
}
