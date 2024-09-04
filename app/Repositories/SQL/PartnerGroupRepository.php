<?php

namespace App\Repositories\SQL;

use App\Models\PartnerGroup;
use App\Repositories\Contracts\PartnerGroupContract;

class PartnerGroupRepository extends BaseRepository implements PartnerGroupContract
{
    /**
     * PartnerGroupRepository constructor.
     * @param PartnerGroup $model
     */
    public function __construct(PartnerGroup $model)
    {
        parent::__construct($model);
    }
}
