<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\MedicalConsultingContract;

class MedicalConsultingService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(MedicalConsultingContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


}
