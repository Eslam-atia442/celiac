<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\BaseService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Roles
 */
class RoleController extends BaseApiController
{
    protected BaseService $service;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->service = $roleService;
        $this->relations = ['permissions', 'users.avatar'];
        parent::__construct($roleService, RoleResource::class, 'role');
    }
    /**
    * Lists
    * add this query parameter to url if you want all data [?page=0] and if you want remove relations add [withoutRelation=1]
    * @response {
    *  "status": 200,
    *  "message": "",
    *  "data":{
    *     "id":1,
    *     "name" :"admin",
    *    }
    *  }
    */
    public function index(): mixed
    {
         if(request()->has('withoutRelation')){
            $this->relations = [];
        }
        request()->merge(['withUsersCount'=> true]);
        return parent::index();
    }
    /**
     * Store
     *
     * @bodyParam name string required
     * @bodyParam role_permissions array required
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"admin",
     *  }
     * }
     */
    public function store(RoleRequest $request): JsonResponse
    {
        try {
            $role = $this->service->create($request->validated());
            return $this->respondWithModel($role);
        } catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Show
     *
     * @urlParam  id number required
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"admin",
     *  }
     * }
     */

    public function show(Role $role): JsonResponse
    {
        try {
            return $this->respondWithModel($role->load('permissions', 'users'));
        } catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Update
     *
     * @urlParam  id number required
     * @bodyParam name string required
     * @bodyParam role_permissions array required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"admin",
     *  }
     * }
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        try {
            $role = $this->service->update($role, $request->validated());
            return $this->respondWithModel($role);
        } catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
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
    public function destroy(Role $role): JsonResponse
    {
        try {
            if ($role->can_be_deleted){
                $this->service->remove($role);
                return $this->respondWithSuccess(__('role deleted successfully'));
            }
            return $this->respondWithError(__('role can not be deleted'));

        } catch (Exception $exception) {
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Change Status
     *
     * @urlParam  id number required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"admin",
     *  }
     * }
     */
    public function changeActivation(Role $role): JsonResponse
    {
        try {
            $this->service->toggleField($role, 'is_active');
            return $this->respondWithModel($role->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
