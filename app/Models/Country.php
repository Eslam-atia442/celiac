<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Country extends \Lwwcas\LaravelCountries\Models\Country
{
    use  ModelTrait, SearchTrait;

    protected $fillable = [];


}
