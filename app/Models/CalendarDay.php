<?php

namespace App\Models;

use App\Services\Hijri;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CalendarDay extends Model
{
    use ModelTrait, SearchTrait, HasTranslations, hasFactory;

    protected $fillable = [ 'day_date', 'clinic_id' ];
    protected array $filters = [ 'keyword', 'month', 'dayDate', 'clinic' ];
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

    protected $appends = [ 'day_date_hijri' ];

    //--------------------- casting  -------------------------------------

    public function getDayDateHijriAttribute()
    {
        if (!empty($this->attributes['day_date'])) {
            return Hijri::date('Y-m-d', $this->attributes['day_date']);
        }
    }

    //--------------------- relations -------------------------------------
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    //--------------------- functions -------------------------------------

    public function getAvailableTimes()
    {

        $clinic = $this->clinic;
        $bookedTimes = $clinic->AlreadyBookedTimes($this->day_date)->pluck('scheduled_time')->toArray();
        $duration = $clinic->duration;
        $clinic_start_time = Carbon::createFromTimeString($clinic->start_time);
        $clinic_end_time = Carbon::createFromTimeString($clinic->end_time);
        $diffInMinutes = $clinic_start_time->diffInMinutes($clinic_end_time);
        $intervals = floor($diffInMinutes / $duration);

        $time = [];
        for ($i = 0; $i <= $intervals; $i++) {
            $time[] = Carbon::createFromTimeString($clinic->start_time)->addMinutes($i * $duration)->format('H:i');
        }
        $times = array_diff($time, $bookedTimes);
        return $times;
    }

    //--------------------- scopes -------------------------------------
    public function scopeOfMonth(Builder $query): Builder
    {
        return $query->whereMonth('day_date', request('month'))->whereYear('day_date', request('year'));
    }

    public function scopeOfDayDate(Builder $query, $date): Builder
    {
        return $query->where('day_date', $date);
    }

    public function scopeOfClinic(Builder $query, $clinic_id): Builder
    {
        return $query->whereIn('clinic_id', (array)$clinic_id);
    }
}
