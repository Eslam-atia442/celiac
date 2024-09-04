<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup User
 */
class UserController extends BaseApiController
{
    /**
     * UserController constructor.
     * @param UserService $service
     */


    public function __construct(UserService $service)
    {
        $this->service = $service;
        parent::__construct($service, UserResource::class, 'user');
    }

    public function index(): mixed
    {
        \request()->merge([
            'type' => UserTypeEnum::user->value,
            'scope' => 'full',
        ]);

        return parent::index();
    }

    /**
     * Store a newly created resource in storage.
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $user = $this->service->create($request->validated());
            return $this->respondWithModel($user->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {

        try {
            return $this->respondWithModel($user->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $user = $this->service->update($user, $request->validated());
            return $this->respondWithModel($user->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $deletedUser = $this->service->clientRemove($user);
            if ($deletedUser)
                return $this->respondWithSuccess(__('messages.deleted'));
            return $this->respondWithError(__('messages.validation.not_found'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param User $user
     * @return JsonResponse
     */
    public function changeActivation(User $user): JsonResponse
    {
        try {
            $this->service->toggleField($user, 'is_active');
            return $this->respondWithModel($user->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
