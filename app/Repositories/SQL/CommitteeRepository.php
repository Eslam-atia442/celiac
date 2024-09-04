<?php

namespace App\Repositories\SQL;

use App\Models\Committee;
use App\Repositories\Contracts\CommitteeContract;

class CommitteeRepository extends BaseRepository implements CommitteeContract
{
    /**
     * CommitteeRepository constructor.
     * @param Committee $model
     */
    public function __construct(Committee $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $attributes
     * @return void
     */
    public function updateCommitteeTasks($attributes): void
    {
        foreach ($attributes['committees'] as $key => $attribute){
            $this->model->where('id', $attribute['id'])
                        ->update(['tasks'=>[
                            'ar'=>$attribute['tasks'],
                            'en'=>$attribute['tasks'],
                        ]]);
        }
    }
}
