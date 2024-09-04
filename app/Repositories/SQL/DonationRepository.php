<?php

namespace App\Repositories\SQL;

use App\Models\Donation;
use App\Repositories\Contracts\DonationContract;

class DonationRepository extends BaseRepository implements DonationContract
{
    /**
     * DonationRepository constructor.
     * @param Donation $model
     */
    public function __construct(Donation $model)
    {
        parent::__construct($model);
    }
}
