<?php

namespace App\Repositories\SQL;

use App\Models\PatientAwareness;
use App\Repositories\Contracts\PatientAwarenessContract;

class PatientAwarenessRepository extends BaseRepository implements PatientAwarenessContract
{
    /**
     * PatientAwarenessRepository constructor.
     * @param PatientAwareness $model
     */
    public function __construct(PatientAwareness $model)
    {
        parent::__construct($model);
    }
}
