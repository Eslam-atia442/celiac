<?php

namespace App\Http\Controllers\Dashboard\V1;

use Exception;
use App\Models\User;
use App\Enums\FileEnum;
use App\Enums\UserTypeEnum;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Http\Controllers\BaseApiController;
/**
 * @group Dashboard
 * @subgroup Admin
 */
class AdminController extends BaseApiController
{
    public string $type;
    public string $path;
    /**
     * AdminController constructor.
     * @param UserService $service
     */


    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->relations = ['roles', 'avatar'];
        $this->type = FileEnum::file_type_user_avatar->value;
        $this->path = config('filesystems.upload.paths.admins');
        parent::__construct($service, AdminResource::class, 'admin');
    }

    /**
     * Lists
     * @queryParam role integer The ID of the role for filter. Example: 1
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "email" :"ahlamelhna@gmail.com",
     *  }
     * }
     */
    public function index(): mixed
    {
        \request()->merge(['type' => UserTypeEnum::admin->value]);
        return parent::index();
    }

    /**
     * Store
     *
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam role_id integer required
     * @bodyParam password string required
     * @bodyParam image file optional
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *  }
     * }
     */
    public function store(AdminRequest $request): JsonResponse
    {
        try {
            $admin = $this->service->createAdmin($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($admin->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Show
     * @urlParam  id number required
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *  }
     * }
     */
    public function show(User $admin): JsonResponse
    {

        try {
            return $this->respondWithModel($admin->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update
     * @urlParam  id number required
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam password string optional
     * @bodyParam image file optional
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *  }
     * }
     */
    public function update(AdminRequest $request, User $admin): JsonResponse
    {
        try {
            $admin = $this->service->updateAdmin($admin, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($admin->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete
     *
     * @urlParam  id number required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     * }
     */
    public function destroy(User $admin): JsonResponse
    {
        try {
            if ($admin->can_delete){
                $this->service->remove($admin);
                return $this->respondWithSuccess(__('messages.responses.deleted'));
            }
             return  $this->respondWithError(__('messages.responses.can_not_delete'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Change Status
     * @urlParam  id number required
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *  }
     * }
     */
    public function changeActivation(User $admin): JsonResponse
    {
        try {
            $this->service->toggleField($admin, 'is_active');
            return $this->respondWithModel($admin->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
