<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\ReservationStatusEnum;
use App\Enums\ReservationTypeEnum;
use App\Services\Hijri;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Reservation extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations, HasFactory;

    protected $guarded = [ 'id' ];
    protected array $filters = [ 'keyword', 'user', 'status', 'type' ];
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
    protected $appends = [ 'type_text', 'status_text', 'gender_text', 'scheduled_at_hijri'/*, 'rate'*/ ];

    //--------------------- casting  -------------------------------------

    /*    public function getRateAttribute()
        {
            $rate = $this->rates()->avg('rate');
            return (int)$rate;
        }*/

    public function getScheduledTimeAttribute()
    {
        // change for time H:i
        return Carbon::createFromTimeString($this->attributes['scheduled_time'])->format('H:i');
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            ReservationStatusEnum::active->value => __('messages.responses.active'),
            ReservationStatusEnum::completed->value => __('messages.responses.completed'),
            ReservationStatusEnum::canceled->value => __('messages.responses.canceled'),
            default => null
        };
    }

    public function getTypeTextAttribute()
    {
        return match ($this->type) {
            ReservationTypeEnum::onsite->value => __('messages.responses.onsite'),
            ReservationTypeEnum::online->value => __('messages.responses.online'),
            default => null
        };
    }

    public function getGenderTextAttribute()
    {
        return match ($this->gender) {
            GenderEnum::male->value => __('messages.responses.male'),
            GenderEnum::female->value => __('messages.responses.female'),
            default => null
        };
    }

    public function getScheduledAtHijriAttribute()
    {
        if ($this->scheduled_date)
            return Hijri::date('Y-m-d', $this->attributes['dob']);
    }

    //--------------------- relations -------------------------------------

    public function rate()
    {
        return $this->morphOne(Rate::class, 'rateable');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable',);
    }

    public function userRate()
    {
        if (auth()->check())
            return $this->morphOne(Rate::class, 'rateable',)->where('user_id', auth()->id());
        else
            return null;
    }

    //--------------------- functions -------------------------------------

    //--------------------- scopes -------------------------------------

    public function scopeOfUser($query, $id)
    {
        return $query->wherein('user_id', (array)$id);
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->whereIn('status', (array)$status);
    }

    public function scopeOfType($query, $type)
    {
        return $query->whereIn('type', (array)$type);
    }
}
