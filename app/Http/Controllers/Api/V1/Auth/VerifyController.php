<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Website\Auth\CodeValidateRequest;
use App\Http\Requests\Website\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserContract;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * @group Api
 * @subgroup Authentication
 */
class VerifyController extends BaseApiController
{


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class);
    }

    /**
     * Verify code
     *
     * @bodyParam code string required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *
     *  }
     *
     *
     */


    public function __invoke(CodeValidateRequest $request): mixed
    {
        $this->service->verifyCode($request);
        return $this->respondWithSuccess('code verified successfully');
    }
}
