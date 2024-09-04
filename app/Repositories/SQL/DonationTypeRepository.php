<?php

namespace App\Repositories\SQL;

use App\Models\DonationType;
use App\Repositories\Contracts\DonationTypeContract;

class DonationTypeRepository extends BaseRepository implements DonationTypeContract
{
    /**
     * DonationTypeRepository constructor.
     * @param DonationType $model
     */
    public function __construct(DonationType $model)
    {
        parent::__construct($model);
    }
}
