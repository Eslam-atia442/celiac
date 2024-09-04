<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Repositories\Contracts\PermissionContract;
use App\Services\PermissionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Permissions
 */

class PermissionController extends BaseApiController
{
    /**
     * PermissionController constructor.
     * @param PermissionService $repository
     */
    public function __construct(PermissionService $repository)
    {
        parent::__construct($repository, PermissionResource::class);
    }

    public function __invoke(): Collection|JsonResponse|array
    {
        $models = Permission::all()->groupBy('model');
        return $this->respondWithJson($models);
    }
}
