<?php

namespace App\Services;

use App\Enums\ReservationStatusEnum;
use App\Enums\ReservationTypeEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\ReservationContract;

class ReservationService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(ReservationContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


    public function create($request)
    {
        $request['user_id'] = auth()->id();
        $request['reservation_number'] = rand(100000, 999999) . '-' . now()->timestamp;;
        return $this->repository->create($request);
    }

    public function update($modelObject, $request)
    {

        return $this->repository->update($modelObject, $request);
    }
    public function cancel($modelObject)
    {
        $request['status'] = ReservationStatusEnum::canceled->value; ;
        return $this->repository->update($modelObject, $request);
    }

}
