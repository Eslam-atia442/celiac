<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\FaqContract;

class FaqService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(FaqContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


}
