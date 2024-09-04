<?php

namespace App\Repositories\SQL;

use App\Models\HealthLibrary;
use App\Repositories\Contracts\HealthLibraryContract;

class HealthLibraryRepository extends BaseRepository implements HealthLibraryContract
{
    /**
     * HealthLibraryRepository constructor.
     * @param HealthLibrary $model
     */
    public function __construct(HealthLibrary $model)
    {
        parent::__construct($model);
    }

    public function checkLibraryExist($value, $id = null)
    {
        return $this->model->whereTitle($value)->whereType(request()->type)->whereNull('deleted_at')
            ->where('id', '!=', $id)
            ->count();
    }
}
