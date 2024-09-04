<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends \Spatie\Permission\Models\Role
{
    use ModelTrait, SearchTrait, SoftDeletes;

    public const DEFAULT_ROLE_SUPER_ADMIN = 'Super Admin';
    public const DEFAULT_ROLE = [
        self::DEFAULT_ROLE_SUPER_ADMIN,
    ];

    public const ADDITIONAL_PERMISSIONS = [];
    protected $fillable = [ 'id', 'name', 'name_ar', 'type', 'guard_name', 'is_active' ];
    protected array $filters = [ 'keyword', 'withUsersCount' ];
    protected array $searchable = [ 'name' ];
    public array $restrictedRelations = [ 'users' ];

    #scopes
    public function scopeOfWithUsersCount($query, $value)
    {
        if ($value) {
            return $query->withCount('users');
        }
        return $query;
    }
}
