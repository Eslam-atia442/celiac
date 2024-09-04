<?php

namespace App\Repositories\SQL;

use App\Models\HajjRequest;
use App\Repositories\Contracts\HajjRequestContract;

class HajjRequestRepository extends BaseRepository implements HajjRequestContract
{
    /**
     * HajjRequestRepository constructor.
     * @param HajjRequest $model
     */
    public function __construct(HajjRequest $model)
    {
        parent::__construct($model);
    }
}
