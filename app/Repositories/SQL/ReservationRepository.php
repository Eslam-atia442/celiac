<?php

namespace App\Repositories\SQL;

use App\Models\Reservation;
use App\Repositories\Contracts\ReservationContract;

class ReservationRepository extends BaseRepository implements ReservationContract
{
    /**
     * ReservationRepository constructor.
     * @param Reservation $model
     */
    public function __construct(Reservation $model)
    {
        parent::__construct($model);
    }
}
