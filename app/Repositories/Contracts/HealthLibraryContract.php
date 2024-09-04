<?php

namespace App\Repositories\Contracts;

interface HealthLibraryContract extends BaseContract
{
    public function checkLibraryExist($value, $id = null);
}

