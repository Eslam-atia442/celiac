<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'name', 'email', 'phone', 'message', 'reply_message', 'is_reply', 'country_code' ];
    protected array $filters = [ 'keyword', 'reply' ];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const ADDITIONAL_OTHER_PERMISSIONS = [
        "ContactUs" => [
            "read",
        ]
    ];
    public const PERMISSIONS_NOT_APPLIED = true;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------

    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------
    public function scopeOfReply($query, $value): mixed
    {
        return $query->whereIn('is_reply', (array)$value);
    }

}
