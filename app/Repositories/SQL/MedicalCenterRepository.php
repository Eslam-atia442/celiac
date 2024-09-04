<?php

namespace App\Repositories\SQL;

use App\Models\MedicalCenter;
use App\Repositories\Contracts\MedicalCenterContract;

class MedicalCenterRepository extends BaseRepository implements MedicalCenterContract
{
    /**
     * MedicalCenterRepository constructor.
     * @param MedicalCenter $model
     */
    public function __construct(MedicalCenter $model)
    {
        parent::__construct($model);
    }
}
