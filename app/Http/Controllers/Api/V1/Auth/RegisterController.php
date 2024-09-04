<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\BaseApiController;
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
class RegisterController extends BaseApiController
{


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class);
    }

    /**
     * Register
     *
     * @bodyParam name string required
     * @bodyParam phone string required
     * @bodyParam email email required
     * @bodyParam birthdate date required
     * @bodyParam is_saudi boolean required
     * @bodyParam civil_id number required if is_saudi is true
     * $bodyParam password string required
     * $bodyParam password_confirmation string required
     * @bodyParam residency_number number required if is_saudi is false
     * @bodyParam terms_and_conditions boolean required true
 *
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


    public function __invoke(RegisterRequest $request): mixed
    {

        try {
            DB::beginTransaction();
            $user = $this->service->register($request->validated());
            DB::commit();
            return $this->respondWithModel($user) ;
        }catch (Exception $exception) {
            DB::rollBack();
            return $exception ->getMessage();
        }

    }
}
