<?php

namespace App\Repositories\SQL;

use App\Models\Position;
use App\Repositories\Contracts\PositionContract;

class PositionRepository extends BaseRepository implements PositionContract
{
    /**
     * PositionRepository constructor.
     * @param Position $model
     */
    public function __construct(Position $model)
    {
        parent::__construct($model);
    }
}
