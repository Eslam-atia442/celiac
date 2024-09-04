<?php

namespace App\Services;


use App\Enums\BooleanEnum;

use App\Enums\UserTypeEnum;
use App\Mail\Dashboard\ResetPasswordByCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\UserContract;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(UserContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        return $this->repository->create($request);
    }

    public function login($request, $loginBy = 'phone')
    {
        $userCheck = ['user' => false, 'message' => __('messages.validation.wrong_credentials')];
        if (Auth::validate($request->only($loginBy, 'password'))) {
            $user = $this->repository->findBy($loginBy, $request->input($loginBy));
            return $this->checkUserData($user, $loginBy, $request);
        }
        return $userCheck;
    }

    private function checkUserData($user, $loginBy, $request): array
    {
        $message = '';
        if ($loginBy == 'phone') {
            if ($user->is_active == BooleanEnum::false->value) {
                $message = __('messages.validation.user_not_active');
                return ['user' => false, 'message' => $message];

            }
            if ($user && $user->type != UserTypeEnum::user->value) {
                $message = __('messages.validation.wrong_credentials');
                return ['user' => false, 'message' => $message];
            }
            if ($user && !$user->verified_at) {
                $message = __('messages.responses.please_verify_your_phone_number');
                return ['user' => false, 'message' => $message, 'status' => 410];
            }
        }
        if ($loginBy == 'email') {

            if ($user->is_active == BooleanEnum::false->value) {
                $message = __('messages.validation.you_no_longer_have_login_permission_you_can_contact_the_administration');
                return ['user' => false, 'message' => $message];

            }

            if ($user && $user->type != UserTypeEnum::admin->value) {
                $message = __('messages.validation.wrong_credentials');
                return ['user' => false, 'message' => $message];
            }

            if(!count($user->roles)){
                $message = __('messages.validation.you_do_not_have_permissions_to_use_the_dashboard');
                return ['user' => false, 'message' => $message];
            }
        }
        if ($user) {
            $expire_at = config('sanctum.expiration');
            $expire_at = now()->addMinutes($expire_at);
            $user->accessToken = $user->createToken('api', ['*'], $expire_at)->plainTextToken;
            $user->load('permissions');
        }

        return ['user' => $user, 'message' => $message];
    }

    public function register($data)
    {
        $user = $this->repository->create($data);
        $code = $this->repository->sendCode($user->phone, $this->createCode(), 'phone');
        $user->code_for_test_only = $code;
        return $user;
    }

    public function phoneNumberValidation($request)
    {
        return $this->repository->findBy('phone', $request->phone);
    }


    public function sendCode($credentials, $sendBy = 'phone'): mixed
    {


        $check = DB::table('password_reset_tokens')
            ->where($sendBy, $credentials[$sendBy])
            ->where('created_at', '>', now()->subMinutes(1))
            ->exists();


        if ($check) {
            throw ValidationException::withMessages([
                $sendBy => [__('messages.responses.code_already_sent')],
            ]);
        }
        $createCode = $this->createCode();
        $code = $this->repository->sendCode($credentials[$sendBy], $createCode, $sendBy);

        try {
            if ($sendBy == 'email')
                Mail::to($credentials[$sendBy])->send(new ResetPasswordByCode($code));

        } catch (\Exception $e) {
            Log::error('error: ' . $e->getMessage());
            Log::error('error: ' . $e->getTraceAsString());
        }
        return $code;
    }

    private function createCode(): int
    {
        $code = rand(1000, 9999);
        $check = DB::table('password_reset_tokens')->where('code', $code)->exists();
        if ($check) {
            $this->createCode();
        }
        return $code;
    }

    public function changePassword($credentials, $sendBy = 'phone'): void
    {
        $this->repository->resetPassword($credentials['code'], $credentials['password'], $sendBy);
    }

    public function verifyCode($request)
    {
        return $this->repository->verifyCode($request->code);
    }

    public function clientRemove($modelObject)
    {
        if ($modelObject->type == UserTypeEnum::admin->value || $modelObject->id == 1) {
            return false;
        }
        return $this->repository->remove($modelObject);
    }


    public function createAdmin($request, $type, $path = '')
    {
        $admin = $this->repository->create($request+['type'=> UserTypeEnum::admin?->value]);
        if(array_key_exists('image', $request)){
            app(FileService::class)->createFile($request['image'], $request, $type, $admin, $path);
        }

        return $admin;
    }

    public function updateAdmin($modelObject, $request, $type, $path = '')
    {
        $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->avatar, $request, $type, $path, $request['image'] ?? '');
        return $modelObject;
    }

    public function checkUserExistByType($email, $type, $id = null)
    {
        return $this->repository->checkUserExistByType($email, $type, $id);

    }
}
