<?php

namespace App\Repositories\SQL;

use App\Models\Banner;
use App\Repositories\Contracts\BannerContract;

class BannerRepository extends BaseRepository implements BannerContract
{
    /**
     * BannerRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }
}
