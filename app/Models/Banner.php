<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'name', 'description', 'is_active', 'url', 'is_redirect' ];
    protected array $filters = [ 'keyword', 'active' ];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [ 'name', 'description' ];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    public function getUrlAttribute()
    {
        return $this->attributes['url'] ?? config('app.url');

    }

    //--------------------- relations -------------------------------------
    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_banner_image->value);
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array)$value);
    }
}
