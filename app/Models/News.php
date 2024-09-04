<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use  ModelTrait, SearchTrait, HasTranslations;
    protected $fillable = ['name', 'description'];
    protected array $filters = ['keyword'];
    protected array $searchable = ['name', 'description'];
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

    //--------------------- functions -------------------------------------

    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_news_image->value);
    }

    //--------------------- scopes -------------------------------------

}
