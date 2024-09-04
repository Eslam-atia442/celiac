<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations, HasFactory;
    protected $fillable = ['name', 'is_active', 'partner_group_id'];
    protected array $filters = ['keyword', 'active', 'partnerGroup'];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = ['name'];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------
    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
                    ->where('type', FileEnum::file_type_partner_image->value);
    }
    public function partnerGroup(): BelongsTo
    {
        return $this->belongsTo(PartnerGroup::class, 'partner_group_id');
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array) $value);
    }
    public function scopeOfPartnerGroup($query, $value): mixed
    {
        if(empty($value)){
            return $query;
        }
        return $query->whereIn('partner_group_id', (array) $value);
    }
}
