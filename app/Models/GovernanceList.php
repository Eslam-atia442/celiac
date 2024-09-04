<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class GovernanceList extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations, HasTranslations;

    protected $fillable = [ 'name', 'is_active' ];
    protected array $filters = [ 'keyword', 'active', 'withActiveFileCount' ];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [ 'name' ];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable')
            ->whereType(FileEnum::file_type_governance_attachments->value);
    }

    public function activeFiles(): MorphMany
    {
        return $this->files()->where('is_active', BooleanEnum::true->value);
    }



    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------
    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array)$value);
    }

    public function scopeOfWithActiveFileCount($query, $value)
    {
        if ($value) {
            return $query->withCount('activeFiles');
        }
        return $query;
    }

}
