<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\CalendarDayContract;

class CalendarDayService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(CalendarDayContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function enableDays(array $data): void
    {
        $this->repository->enableDays($data);
    }

    public function disableDays(array $data): void
    {
        $this->repository->disableDays($data);
    }


}
