<?php

namespace App\Repositories\SQL;

use App\Models\MedicalConsulting;
use App\Repositories\Contracts\MedicalConsultingContract;

class MedicalConsultingRepository extends BaseRepository implements MedicalConsultingContract
{
    /**
     * MedicalConsultingRepository constructor.
     * @param MedicalConsulting $model
     */
    public function __construct(MedicalConsulting $model)
    {
        parent::__construct($model);
    }
}
