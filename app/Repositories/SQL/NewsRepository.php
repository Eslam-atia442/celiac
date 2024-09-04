<?php

namespace App\Repositories\SQL;

use App\Models\News;
use App\Repositories\Contracts\NewsContract;

class NewsRepository extends BaseRepository implements NewsContract
{
    /**
     * NewsRepository constructor.
     * @param News $model
     */
    public function __construct(News $model)
    {
        parent::__construct($model);
    }
}
