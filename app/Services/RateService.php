<?php

namespace App\Services;

use App\Models\Reservation;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\RateContract;
use App\Repositories\SQL\ReservationRepository;

class RateService extends BaseService
{

    protected BaseContract $repository;


    public function __construct(RateContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        $reservation = app(ReservationService::class)->find($request['reservation_id']);
        if ($reservation->userRate) {
            return false;
        }
        $request['rateable_id'] = $reservation->id;
        $request['rateable_type'] = 'Reservation';
        $request['user_id'] = auth()->id();
        return $this->repository->create($request);
    }

}
