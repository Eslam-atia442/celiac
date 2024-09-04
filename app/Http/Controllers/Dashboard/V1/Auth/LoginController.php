<?php

namespace App\Http\Controllers\Dashboard\V1\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserContract;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * @group Dashboard
 * @subgroup Authentication
 */
class LoginController extends BaseApiController
{
    /**
     * LoginController constructor.
     * @param UserService $service
     *
     * @example email = admin@celiac.com
     * @example password = celiac@123
     *
     */


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class);
    }

    /**
     * Dashboard Login.
     * @bodyParam email string required The email of the user Example: admin@celiac.com
     * @bodyParam password string required The password of the user Example: celiac@123
     * @param Request $request
     *
     *  @bodyParam  email string required Email. Example: admin@celiac.com
     *  @bodyParam password string required Password. Example: celiac@123
     *
     *
     * @return JsonResponse]
     *
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $data = $this->service->login($request, 'email');
        if ($data['user'])
            return $this->respondWithModel($data['user']);
        else
            return $this->errorWrongArgs($data['message']);

    }
}
