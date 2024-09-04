<?php

namespace App\Repositories\SQL;

use App\Models\Role;
use App\Repositories\Contracts\RoleContract;
use Illuminate\Support\Arr;

class RoleRepository extends BaseRepository implements RoleContract
{
    /**
     * RoleRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []): mixed
    {
        $role = parent::create($attributes);
        $role = $this->syncPermissions($role, $attributes);
        return $role->refresh();
    }

    public function update($model, array $attributes = []): mixed
    {
        $role = parent::update($model, $attributes);
        $role = $this->syncPermissions($role, $attributes);
        return $role->refresh();
    }

    public function syncPermissions($model, array $attributes = []): mixed
    {
        if(array_key_exists('role_permissions', $attributes)){
            $requestPermissions = $attributes['role_permissions']?
                array_filter(Arr::flatten(array_values($attributes['role_permissions']))) :[];
            $model->syncPermissions($requestPermissions);
        }
        return $model->refresh();
    }

}
