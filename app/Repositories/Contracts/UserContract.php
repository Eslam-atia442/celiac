<?php

namespace App\Repositories\Contracts;

interface UserContract extends BaseContract
{
    public function sendCode($via , $code ,$sendBy);
    public function resetPassword($code, $password ,$sendBy);
    public function verifyCode($code);
    public function checkUserExistByType($value, $type, $id = null);
}

