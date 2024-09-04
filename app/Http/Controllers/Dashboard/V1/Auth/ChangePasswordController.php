<?php

namespace App\Http\Controllers\Dashboard\V1\Auth;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Dashboard
 * @subgroup Authentication
 */

class ChangePasswordController extends BaseApiController
{

    /**
     * Dashboard change password.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): void
    {

    }
}
