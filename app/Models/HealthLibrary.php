<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Enums\GuidanceManualFileTypeEnum;
use App\Enums\HealthLibraryTypeEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class HealthLibrary extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'title', 'type', 'description', 'author_name', 'is_active', 'file_type' ];
    protected array $filters = [ 'keyword', 'active', 'type' ];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = true;
    public const DISABLE_LOG = false;
    public const ADDITIONAL_OTHER_PERMISSIONS = [
        'ScientificResearch' => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'TranslatedBook'     => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'GuidanceManual'     => [
            'read',
            'create',
            'update',
            'delete'
        ],
    ];
    //--------------------- casting  -------------------------------------
    public $casts = [
        'type'      => HealthLibraryTypeEnum::class,
        'file_type' => GuidanceManualFileTypeEnum::class
    ];

    //--------------------- relations -------------------------------------
    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_health_library_image->value)->latest();
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_health_library_file->value)->latest();
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------
    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array)$value);
    }

    public function scopeOfType($query, $value): mixed
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereIn('type', (array)$value);
    }
}
