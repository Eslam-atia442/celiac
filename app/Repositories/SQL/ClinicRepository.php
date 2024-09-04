<?php

namespace App\Repositories\SQL;

use App\Models\Clinic;
use App\Repositories\Contracts\ClinicContract;

class ClinicRepository extends BaseRepository implements ClinicContract
{
    /**
     * SpecialtyRepository constructor.
     * @param Clinic $model
     */
    public function __construct(Clinic $model)
    {
        parent::__construct($model);
    }
}
