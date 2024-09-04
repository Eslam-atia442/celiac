<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Application;
use Spatie\Translatable\HasTranslations;

class MedicalConsulting extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = ['name',
        'email',
        'country_code',
        'phone',
        'civil_id',
        'birthdate',
        'gender',
        'consulting',
        'reply_message',
        'is_reply',
        'reply_user_id'];
    public $table = 'medical_consulting';
    protected array $filters = ['keyword'];
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

    //--------------------- attributes  -------------------------------------
    public function getReplyStatusAttribute(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return $this->is_reply ? __('replied') : __('not_replied');
    }

    public function getReplyClassAttribute(): string
    {
        return $this->is_reply ? 'success' : 'warning';
    }
    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------
    public function replyUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

}
