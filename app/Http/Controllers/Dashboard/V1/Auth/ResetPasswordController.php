<?php

namespace App\Http\Controllers\Dashboard\V1\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\KsaPhoneNumber;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @group Dashboard
 * @subgroup Authentication
 */

class ResetPasswordController extends BaseApiController
{


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class);
    }

    /**
     * email validation
     *
     * @bodyParam email string required
     * @response {
     *  "status": 200,
     *  "message": "code send successfully",
     *
     *
     *}
     */


    public function emailValidation(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', Rule::exists('users', 'email')
                ->where('is_active', BooleanEnum::true->value)
                ->where('type', UserTypeEnum::admin->value)],
        ]);


        $code = $this->service->sendCode($credentials,'email');

        $code = config('app.env') == 'local' ? $code : null;

        return $this->respondWithSuccess(__('messages.responses.code_send_successfully  '. $code));
    }

    /**
     * code validation
     *
     * @bodyParam phone number
     * @response {
     *  "status": 200,
     *  "message": "code is correct",
     *      "data":{
     *
     *    }
     *}
     */


    public function sendCode(Request $request): JsonResponse
    {
        $request->validate([
            'code' => ['required', Rule::exists('password_reset_tokens', 'code')->where(function ($query) {
                $query->where('created_at', '>', now()->subMinutes(1));
            })],
        ]);

        return $this->respondWithSuccess(__('messages.responses.code is correct'));
    }

    /**
     * change password
     *
     * @response {
     *  "status": 200,
     *  "message": "code send successfully",
     *
     * }
     *
     */

    public function changePassword(Request $request): JsonResponse
    {

         $credentials = $request->validate([
            'code' => ['required', Rule::exists('password_reset_tokens', 'code')  ],
            'password' => [
                'required',
                'confirmed',
                Password::min(6),
            ],
            'password_confirmation' => ['required'],
        ]);



        $this->service->changePassword($credentials, 'email');
        return $this->respondWithSuccess(__('password changed successfully'));
    }
}
