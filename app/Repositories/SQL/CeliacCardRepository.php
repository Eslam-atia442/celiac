<?php

namespace App\Repositories\SQL;

use App\Models\CeliacCard;
use App\Repositories\Contracts\CeliacCardContract;

class CeliacCardRepository extends BaseRepository implements CeliacCardContract
{
    /**
     * CeliacCardRepository constructor.
     * @param CeliacCard $model
     */
    public function __construct(CeliacCard $model)
    {
        parent::__construct($model);
    }
}
