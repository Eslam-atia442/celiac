<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CeliacCard extends Model
{
    use ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [
        'full_name',
        'user_id',
        'phone',
        'email',
        'dob',
        'is_saudi',
        'residency_number',
        'national_id',
        'address',
        'gender',
        'status'
    ];
    protected array $filters = [ 'keyword', 'statusSearch' ];
    protected array $searchable = [
        'full_name',
        'phone',
        'email',
        'dob',
        'is_saudi',
        'residency_number',
        'national_id',
        'address',
        'gender',
        'status'
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

    public function medicalReport(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_celiac_card_medical_report->value);
    }

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
