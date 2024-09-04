<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Website\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserContract;
use App\Rules\KsaPhoneNumber;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * @group Api
 * @subgroup Authentication
 */
class LoginController extends BaseApiController
{


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class);
    }

    /**
     * login
     *
     * @bodyParam phone number
     * @bodyParam password string required
     * @bodyParam remember_me nullable
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "user":{
     *          "id":1,
     *          "name":"test user",
     *          .....
     *       }
     *   }
     * }
     *
     */


    public function __invoke(LoginRequest $request): JsonResponse
    {
        $data = $this->service->login($request);

         if ($data['user'])
            return $this->respondWithModel($data['user']);
        else
            return $this->respondWithError($data['message'] , $data['status'] ?? 500);
    }
}
