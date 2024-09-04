<?php

namespace App\Models;

use App\Enums\FileEnum;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use ModelTrait;

    protected $fillable = [
        "name", "ext", "url", "type", "width", "height",
        "mime", "fileable_type", "fileable_id", "duration", "user_id",
        "custom_name", 'notes', 'is_active', "size"
    ];

    public $filters = [ 'type', 'active', 'fileId', 'untracked', 'notType' ];
    public $casts = [
        'type' => FileEnum::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [ 'id' ];

    public const PERMISSIONS_NOT_APPLIED = true;

    public const ADDITIONAL_OTHER_PERMISSIONS = [
        'BoardDirectorMeeting'   => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'GeneralAssemblyMeeting' => [
            'read',
            'create',
            'update',
            'delete'
        ],
        'GovernanceFile'         => [
            'read',
            'create',
            'update',
            'delete'
        ],
    ];

    /**
     * Get the owning fileable model.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('all', function (Builder $builder) {
            $builder->orderBy('id', 'Desc');
        });
        static::deleting(function ($file) { // before delete() method call this
            if (isset($file->url)) {
                if (Storage::exists($file->url)) {
                    Storage::delete($file->url);
                }
            }
        });
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------- scopes
    public function scopeOfUntracked($query)
    {
        return $query->whereNull('fileable_type');
    }

    public function scopeOfActive($query, $value)
    {
        return $query->whereIn('is_active', (array)$value);
    }

    public function scopeOfType($query, $value)
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereIn('type', (array)$value);
    }

    public function scopeOfFileId($query, $value)
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereIn('fileable_id', (array)$value);
    }

    public function scopeOfNotType($query, $value)
    {
        if (empty($value)) {
            return $query;
        }
        return $query->whereNotIn('type', (array)$value);
    }


    public function getOriginalNameAttribute()
    {
        return $this->custom_name ?? substr($this->name, strpos($this->name, '-') + 1);
    }


}
