<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\ReviewContract;

class ReviewService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(ReviewContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


}
