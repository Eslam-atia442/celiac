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

class JobRequest extends Model
{
    use  ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [
        'user_id',
        'status',
        'full_name',
        'email',
        'phone',
        'city',
        'dob',
        'is_saudi',
        'is_infected',
        'residency_number',
        'national_id',
        'gender'
    ];
    protected array $filters = [ 'keyword', 'statusSearch' ];
    protected array $searchable = [
        'full_name',
        'email',
        'phone',
        'city',
        'is_saudi',
        'is_infected',
        'residency_number',
        'national_id',
        'gender'
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
    public function cv()
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_job_request_cv->value);
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
