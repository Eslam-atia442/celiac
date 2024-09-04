<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class MedicalCenter extends Model
{
    use  ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'title', 'author_name', 'description', 'type', 'video_url', 'video_type' ];
    protected array $filters = [ 'keyword', 'type', 'videoType' ];
    protected array $searchable = [];
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
            ->whereType(FileEnum::file_type_medical_center_image->value);
    }

    public function pdf(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_medical_center_pdf->value);
    }


    //--------------------- scopes -------------------------------------
    public function scopeOfType($query, $type)
    {
        return $query->whereIn('type', (array)$type);
    }

    public function scopeOfVideoType($query, $type)
    {

        return $query->where('video_type', 'like', '%' . $type . '%');
    }


}
