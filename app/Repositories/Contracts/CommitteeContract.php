<?php

namespace App\Repositories\Contracts;

interface CommitteeContract extends BaseContract
{
    public function updateCommitteeTasks($attributes): void;
}

