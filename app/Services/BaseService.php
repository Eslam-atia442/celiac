<?php

namespace App\Services;


use App\Repositories\Contracts\BaseContract;

class BaseService
{
    protected BaseContract $repository;

    public function __construct(BaseContract $repository)
    {
        $this->repository = $repository;
    }

    public function search($data = [], $relations = [])
    {

        $filters = request()->all();
        $page = request()->has('page') ? request('page') : 1;
        $limit = request()->has('limit') ? request('limit') : 10;
        $order = request()->has('order') ? request('order') : [];

        $data = array_merge(request()->all(), ['order' => $order, 'limit' => $limit, 'page' => $page]);

        return $this->repository->search($filters, $relations, $data);

    }

    public function create($request)
    {
        return $this->repository->create($request);
    }

    public function update($modelObject, $request)
    {
        return $this->repository->update($modelObject, $request);
    }

    public function remove($modelObject)
    {
        return $this->repository->remove($modelObject);
    }

    public function toggleField($modelObject , $field)
    {
        return $this->repository->toggleField($modelObject , $field);
    }

    public function find(int $id, array $relations = [], array $filters = [])
    {
        return $this->repository->find($id, $relations, $filters);
    }
}
