<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Rate extends Model
{
    use ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'rateable_type', 'rateable_id', 'user_id', 'rate' ];
    protected array $filters = [ 'keyword' ];
    protected array $searchable = [];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = true;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

}
