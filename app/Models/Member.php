<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use App\Enums\MemberTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;


class Member extends Model
{
    use SoftDeletes, ModelTrait, SearchTrait, HasTranslations;

    protected $fillable = ['name', 'type', 'position_name', 'start_date', 'end_date', 'is_active', 'period', 'position_id', 'committable_type', 'committable_id'];
    protected array $filters = ['keyword', 'type', 'active', 'committee', 'position'];
    public $appends = ['member_period_text'];
    protected array $searchable = ['name'];
    public array $filterModels = [];
    public array $filterCustom = [];
    public array $translatable = [];
    public array $restrictedRelations = [];
    public array $cascadedRelations = [];
    public const ADDITIONAL_PERMISSIONS = [];

    public const ADDITIONAL_OTHER_PERMISSIONS = [
        'BoardDirectorMember' => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'GeneralAssemblyMember' => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'OrganizationalStructureMember' => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'CommitteeMember' => [
            'read',
            'create',
            'update',
            'delete'
        ],
    ];
    public const PERMISSIONS_NOT_APPLIED = true;
    public const DISABLE_LOG = false;
    //--------------------- casting  -------------------------------------
    public $casts = [
        'type' => MemberTypeEnum::class
    ];

    //--------------------- relations -------------------------------------
    public function image(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->whereType(FileEnum::file_type_member_avatar->value);
    }

    public function committable(): MorphTo
    {
        return $this->morphTo();
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    //--------------------- functions -------------------------------------

    // -------------------- Appends --------------------------------
    public function getMemberPeriodTextAttribute(): string
    {
        $date = Carbon::parse($this->start_date)->translatedFormat(config('app.date_format'));
        return $this->period ? __(":period months start from :date", ['period' => $this->period, 'date' => $date]) : '';
    }

    //--------------------- scopes -------------------------------------
    public function scopeOfType($query, $value): mixed
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereIn('type', (array)$value);
    }

    public function scopeOfCommittee($query, $value): mixed
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereHasMorph('committable', [Committee::class], function ($q) use ($value) {
            $q->whereIn('id', (array)$value);
        });
    }

    public function scopeOfActive($query, $value): mixed
    {
        return $query->whereIn('is_active', (array)$value);
    }

    public function scopeOfPosition($query, $value): mixed
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereIn('position_id', (array)$value);
    }

    public function scopeOfKeyword($query, $keyword): mixed
    {
        if (empty($keyword)) {
            return $query;
        }
        return $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhereHas('position', function ($q) use ($keyword) {
                $q->ofKeyword($keyword);
            })->orWhereHasMorph('committable', [Committee::class], function ($q) use ($keyword) {
                $q->ofKeyword($keyword);
            });
    }

}
