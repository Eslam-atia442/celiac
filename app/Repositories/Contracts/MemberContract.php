<?php

namespace App\Repositories\Contracts;

interface MemberContract extends BaseContract
{
    public function getMembersByType($type);

    public function checkMemberExist($value, $id = null);
}

