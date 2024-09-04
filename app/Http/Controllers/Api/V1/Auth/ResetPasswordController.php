<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Website\Auth\CodeValidateRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserContract;
use App\Rules\KsaPhoneNumber;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @group Api
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
     * phone number validation
     *
     * @bodyParam phone number
     * @response {
     *  "status": 200,
     *  "message": "code send successfully",
     *      "data":{
     *       "user":{
     *           "id":1,
     *           "name":"test user",
     *           .....
     *        }
     *    }
     *}
     */


    public function phoneNumberValidation(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'phone' => ['required', new KsaPhoneNumber(), Rule::exists('users', 'phone')
                ->where('is_active', BooleanEnum::true->value)
                ->where('type', UserTypeEnum::user->value)],
        ]);

        $code = $this->service->sendCode($credentials);

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


    public function sendCode(CodeValidateRequest $request): JsonResponse
    {
        return $this->respondWithSuccess(__('messages.responses.code is correct'));
    }

    /**
     * change password
     *
     * @bodyParam phone number
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

        $this->service->changePassword($credentials);
        return $this->respondWithSuccess(__('password changed successfully'));
    }
}
