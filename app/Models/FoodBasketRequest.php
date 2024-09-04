<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FoodBasketRequest extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [
        'user_id',
        'status',
        'full_name',
        'phone',
        'email',
        'dob',
        'is_saudi',
        'national_id',
        'residency_number',
        'address',
        'gender'
    ];
    protected array $filters = [ 'keyword', 'statusSearch' ];
    protected array $searchable = [
        'user_id',
        'status',
        'full_name',
        'phone',
        'email',
        'dob',
        'is_saudi',
        'national_id',
        'residency_number',
        'address',
        'gender'
    ];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------
    public function scopeOfStatusSearch($query, $status)
    {
        return $query->whereIn('status', (array)$status);
    }

}
