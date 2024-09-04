<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class FilterController extends Controller
{
    public function __invoke($model, Request $request): JsonResponse
    {
        $model = app('App\\Models\\' . $model);
        $request = $request->merge(['scope' => 'micro', 'withoutRelation' => true]);
        $only = (array) $request->only;
        $except = (array) $request->except;
        $modelFilters = $model->getFilterModels();
        if (!empty($only)) {
            $modelFilters = array_intersect($modelFilters, $only);
        } elseif (!empty($except)) {
            $modelFilters = array_diff($modelFilters, $except);
        }
        $data = [];
        $filters = $request->all();
        foreach ($modelFilters as $modelFilter) {
            $modelRepo = app('App\\Repositories\\Contracts\\' . $modelFilter . 'Contract');
            $key = Str::plural(lcfirst($modelFilter));
            $data = array_merge($data, [$key =>
                $this->getResource($modelFilter, $modelRepo->searchBySelected(null, [], $filters))
            ]);
        }
        $customFilters = $model->getFilterCustom();
        if (empty($request['customFilters'])) {
            foreach ($customFilters as $customFilter) {
                $data = array_merge($data, ["$customFilter" => $model::$customFilter()]);
            }
        } else {
            foreach ($customFilters as $customFilter) {
                if (in_array($customFilter, $request['customFilters'])) {
                    $data = array_merge($data, ["$customFilter" => $model::$customFilter()]);
                }
            }
        }

        return response()->json($data);
    }

    public function getResource($model, $data): AnonymousResourceCollection
    {
        return match ($model) {
            'User' => UserResource::collection($data),
            'Role' => RoleResource::collection($data),
            'Company' => CompanyResource::collection($data),
            'Customer' => CustomerResource::collection($data),
        };
    }
}
