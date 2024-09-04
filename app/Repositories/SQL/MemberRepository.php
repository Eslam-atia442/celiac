<?php

namespace App\Repositories\SQL;

use App\Models\Member;
use App\Repositories\Contracts\MemberContract;

class MemberRepository extends BaseRepository implements MemberContract
{
    /**
     * MemberRepository constructor.
     * @param Member $model
     */
    public function __construct(Member $model)
    {
        parent::__construct($model);
    }

    public function getMembersByType($type)
    {
        return $this->search([
            'active' => true,
            'type' => $type
        ], ['image', 'position'], ['page' => false, 'limit' => false, 'order' => ['id' => 'desc']]);
    }

    public function checkMemberExist($value, $id = null)
    {
        return $this->model->whereName($value)->wherePositionId(request()->position_id)
            ->whereType(request()->type)->whereNull('deleted_at')->where('id', '!=', $id)
            ->count();
    }

}
