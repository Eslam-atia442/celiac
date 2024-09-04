<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Enums\PatientAwarenessArticleTypeEnum;
use App\Enums\PatientAwarenessTypeEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PatientAwareness extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;
    protected $fillable = ['type', 'content_type', 'article_type', 'title', 'description', 'type_text', 'link'];
    protected array $filters = ['keyword','contentType', 'articleType','type'];
    protected array $searchable = ['type', 'content_type', 'article_type', 'title', 'description', 'type_text', 'link'];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = ['title', 'description', 'type_text'];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;
    protected $appends = [ 'content_type_text', 'type_text', 'article_type_text'];

    //--------------------- casting  -------------------------------------

    public function getContentTypeTextAttribute()
    {
       return match ($this->content_type)
        {
            PatientAwarenessTypeEnum::file->value => __('messages.responses.file'),
            PatientAwarenessTypeEnum::video->value => __('messages.responses.video'),
            PatientAwarenessTypeEnum::article->value => __('messages.responses.article'),
            default => null
        };

    }
    public function getTypeTextAttribute()
    {
       return match ($this->type)
        {
            PatientAwarenessTypeEnum::file->value => __('messages.responses.file'),
            PatientAwarenessTypeEnum::video->value => __('messages.responses.video'),
            PatientAwarenessTypeEnum::article->value => __('messages.responses.article'),
            default => null
        };

    }
    public function getArticleTypeTextAttribute()
    {
       return match ($this->article_type)
        {
            PatientAwarenessArticleTypeEnum::text->value => __('messages.responses.text'),
            PatientAwarenessArticleTypeEnum::link->value => __('messages.responses.link'),
            default => null
        };

    }


    //--------------------- relations -------------------------------------

    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_patient_awareness_image->value);
    }
    public function pdf(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_patient_awareness_pdf->value);
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

    public function scopeOfArticleType($query, $value)
    {
        return $query->where('article_type', $value);
    }
    public function scopeOfContentType($query, $value)
    {
        return $query->where('content_type', $value);
    }
    public function scopeOfType($query, $value)
    {
        return $query->where('type', $value);
    }
}
