<?php

namespace App\Repositories\SQL;

use App\Models\FoodBasketRequest;
use App\Repositories\Contracts\FoodBasketRequestContract;

class FoodBasketRequestRepository extends BaseRepository implements FoodBasketRequestContract
{
    /**
     * FoodBasketRequestRepository constructor.
     * @param FoodBasketRequest $model
     */
    public function __construct(FoodBasketRequest $model)
    {
        parent::__construct($model);
    }
}
