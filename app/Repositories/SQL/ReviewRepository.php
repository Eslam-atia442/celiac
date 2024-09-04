<?php

namespace App\Repositories\SQL;

use App\Models\Review;
use App\Repositories\Contracts\ReviewContract;

class ReviewRepository extends BaseRepository implements ReviewContract
{
    /**
     * ReviewRepository constructor.
     * @param Review $model
     */
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}
