<?php

namespace App\Repositories\SQL;

use App\Models\JobRequest;
use App\Repositories\Contracts\JobRequestContract;

class JobRequestRepository extends BaseRepository implements JobRequestContract
{
    /**
     * JobRequestRepository constructor.
     * @param JobRequest $model
     */
    public function __construct(JobRequest $model)
    {
        parent::__construct($model);
    }
}
