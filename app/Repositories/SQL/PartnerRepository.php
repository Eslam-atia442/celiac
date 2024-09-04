<?php

namespace App\Repositories\SQL;

use App\Models\Partner;
use App\Repositories\Contracts\PartnerContract;

class PartnerRepository extends BaseRepository implements PartnerContract
{
    /**
     * PartnerRepository constructor.
     * @param Partner $model
     */
    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }
}
