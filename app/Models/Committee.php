<?php

namespace App\Models;


use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use App\Enums\MemberTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Committee extends Model
{

    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations, HasTranslations;

    protected $fillable = [ 'name', 'description', 'specialties', 'tasks', 'is_active', 'specialties_title' ];
    protected array $filters = [ 'keyword', 'active' ];
    protected array $searchable = [ 'name', 'description, specialties, tasks' ];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [ 'name', 'description', 'specialties', 'tasks' ];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------
    public function mainIcon(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_committee_main_icon->value);
    }

    public function icon(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_committee_icon->value);
    }

    public function members(): MorphMany
    {
        return $this->morphMany(Member::class, 'committable')
            ->where('type', MemberTypeEnum::members_of_committee->value);
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

}
