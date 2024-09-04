<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class HajjRequest extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;
    protected $fillable = ['user_id',
                           'status',
                           'full_name',
                           'phone',
                           'email',
                           'dob',
                           'is_saudi',
                           'national_id',
                           'is_visitor',
                           'passport_number',
                           'campaign_name',
                           'campaign_number',
                           'transaction_date',
                           'gender'];
    protected array $filters = ['keyword','statusSearch'];
    protected array $searchable = ['full_name', 'phone', 'email', 'dob', 'is_saudi', 'identity_number', 'is_visitor', 'passport_number', 'campaign_name', 'campaign_number', 'transaction_date', 'gender'];
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

    public function file()  // medical report or celice card
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', FileEnum::file_type_hajj_request->value);
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
