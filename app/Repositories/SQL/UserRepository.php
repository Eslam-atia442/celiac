<?php

namespace App\Repositories\SQL;

use App\Enums\FileEnum;
use App\Models\User;
use App\Repositories\Contracts\FileContract;
use App\Repositories\Contracts\UserContract;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserContract
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function syncRelations($attributes, $model): void
    {
        if (isset($attributes['role_id'])) {
            $model->syncRoles($attributes['role_id']);
        }
        if (isset($attributes[FileEnum::file_type_user_avatar->value])) {
            $model->avatar()->delete();
            $fileModel = resolve(FileContract::class)->find($attributes[FileEnum::file_type_user_avatar->value]);
            $model->avatar()->save($fileModel);
        }
    }


    public function sendCode($via, $code, $sendBy): int
    {
        DB::table('password_reset_tokens')->insert([
            $sendBy => $via,
            'code' => $code,
            'created_at' => now()
        ]);

        return $code;
    }

    public function resetPassword($code, $password, $sendBy = 'phone')
    {
        $via = DB::table('password_reset_tokens')->where('code', $code)->select($sendBy)->first()->$sendBy;
        $user=null;
        if ($via)
            $user = User::where($sendBy, $via)->first();
            $user->password = bcrypt($password);
            DB::table('password_reset_tokens')->where($sendBy, $via)->delete();
            $user->save();

        return $user;
    }

    public function verifyCode($code)
    {
        $password_reset_tokens = DB::table('password_reset_tokens')->where('code', $code)->first();
        $phone = $password_reset_tokens->phone;
        $user = User::where('phone', $phone)->first();
        $user->verified_at = now();
        $user->save();
        DB::table('password_reset_tokens')->where('phone', $phone)->delete();
        return $user;
    }

    public function checkUserExistByType($value, $type, $id = null)
    {
        return $this->model->whereEmail($value)
                            ->whereType($type)
                            ->whereNull('deleted_at')->where('id', '!=', $id)
                            ->count();
    }
}
