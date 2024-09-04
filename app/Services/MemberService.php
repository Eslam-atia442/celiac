<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\MemberContract;

class MemberService extends BaseService
{
    protected BaseContract $repository;

    public function __construct(MemberContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function getMembersByType($type)
    {
        return $this->repository->getMembersByType($type);
    }

    public function createMember($request, $type, $path = '')
    {
        $member = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $type, $member, $path);
        return $member;
    }

    public function updateMember($modelObject, $request, $type, $path = '')
    {
        $member = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type, $path, $request['image'] ?? '');
        return $member;
    }

    public function checkMemberExist($name, $id = null)
    {
        return $this->repository->checkMemberExist($name, $id);
    }
}
