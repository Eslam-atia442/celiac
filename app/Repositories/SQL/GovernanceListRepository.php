<?php

namespace App\Repositories\SQL;

use App\Models\GovernanceList;
use App\Repositories\Contracts\GovernanceListContract;

class GovernanceListRepository extends BaseRepository implements GovernanceListContract
{
    /**
     * GovernanceListRepository constructor.
     * @param GovernanceList $model
     */
    public function __construct(GovernanceList $model)
    {
        parent::__construct($model);
    }
}
