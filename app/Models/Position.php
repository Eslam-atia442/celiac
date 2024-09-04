<?php

namespace App\Models;

use App\Enums\PositionTypeEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Position extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations, HasTranslations;

    protected $fillable = [ 'name', 'is_active', 'type' ];
    protected array $filters = [ 'keyword', 'active' ];
    protected array $searchable = [ 'name' ];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [ 'name' ];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;
    public $casts = [
        'type' => PositionTypeEnum::class
    ];
    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------


    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------
    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array)$value);
    }

}
