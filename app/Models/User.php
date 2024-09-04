<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Enums\CeliacCardStatusEnum;
use App\Enums\FileEnum;
use App\Enums\FoodBasketRequestStatusEnum;
use App\Enums\JobRequestStatusEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class User extends Authenticated
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, ModelTrait,
        HasRoles, SearchTrait, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'is_active',
        'civil_id',
        'residency_number',
        'birthdate',
        'verified_at',
        'type',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 'password', 'remember_token', ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ 'email_verified_at' => 'datetime' ];
    protected $appends = [ 'user_resident_type', 'age', 'can_delete' ];


    protected array $filters = [ 'keyword', 'type', 'role', 'active' ];
    public array $searchable = [ 'name', 'email', 'phone' ];
    public array $filterModels = [ 'Role' ];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [ 'posts' ];
    public const ADDITIONAL_PERMISSIONS = [];
    public const ADDITIONAL_OTHER_PERMISSIONS = [
        'Admin' => [
            'read',
            'create',
            'update',
            'delete'
        ],
    ];
    const PERMISSIONS_NOT_APPLIED = false;
    const DISABLE_LOG = false;


    // ----------------------- append columns -----------------------

    public function getUserResidentTypeAttribute($value): string
    {
        if ($this->civil_id) {
            return __('messages.responses.saudi');
        }
        return __('messages.responses.national');
    }

    public function getAgeAttribute($value): ?int
    {
        if ($this->birthdate) {
            return Carbon::parse($this->birthdate)->age;
        }
        return null;
    }

    public function getCanDeleteAttribute()
    {
        return $this->id != 1;
    }


    // ----------------------- relations -----------------------
    public function avatar(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_user_avatar->value);
    }

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function approveCeliacCard(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->
        hasOne(CeliacCard::class, 'user_id')
            ->where('status', CeliacCardStatusEnum::accepted->value)->latestOfMany();
    }

    public function pendingCeliacCard()
    {
        return $this->
        hasOne(CeliacCard::class, 'user_id')
            ->where('status', CeliacCardStatusEnum::pending->value)->latestOfMany();
    }

    public function pendingJobRequest()
    {
        return $this->
        hasOne(JobRequest::class, 'user_id')
            ->where('status', JobRequestStatusEnum::pending->value)->latestOfMany();
    }

    public function pendingFoodBasketRequest()
    {
        return $this->
        hasOne(FoodBasketRequest::class, 'user_id')
            ->where('status', FoodBasketRequestStatusEnum::pending->value)->latestOfMany();
    }

    public function pendingHajjRequest()
    {
        return $this->
        hasOne(FoodBasketRequest::class, 'user_id')
            ->where('status', FoodBasketRequestStatusEnum::pending->value)->latestOfMany();
    }

    // ----------------------- relations -----------------------

    // ----------------------- Scopes -----------------------
    public function scopeOfRole($query, $value)
    {
        return $query->whereHas('roles', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }

    public function scopeOfActive($query, $value)
    {
        return $query->where('is_active', $value);
    }


    public function scopeOfPhone($query, $value)
    {
        return $query->where('phone', $value);
    }

    public function scopeOfType($query, $value)
    {
        return $query->where('type', $value);
    }


    // ----------------------- Scopes -----------------------
    public function setPasswordAttribute($input): void
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    // --------------------- custom filters data -------------------

    // --------------------- custom filters data -------------------


    // override on roles for users
    public function roles(): BelongsToMany
    {
        $relation = $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            PermissionRegistrar::$pivotRole
        );
        if (!PermissionRegistrar::$teams) {
            return $relation
                ->where('is_active', BooleanEnum::true?->value)
                ->whereNull('deleted_at');
        }

        return $relation->wherePivot(PermissionRegistrar::$teamsKey, getPermissionsTeamId())
            ->where(function ($q) {
                $teamField = config('permission.table_names.roles') . '.' . PermissionRegistrar::$teamsKey;
                $q->whereNull($teamField)->orWhere($teamField, getPermissionsTeamId());
            });
    }
}
