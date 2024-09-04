<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = [ 'question', 'answer' ];
    protected array $filters = [ 'keyword' ];
    protected array $searchable = [ 'question', 'answer' ];
    protected array $dates = [];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [ 'question', 'answer' ];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];
    public const PERMISSIONS_NOT_APPLIED = false;
    public const DISABLE_LOG = false;

    //--------------------- casting  -------------------------------------

    //--------------------- relations -------------------------------------

    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

}
