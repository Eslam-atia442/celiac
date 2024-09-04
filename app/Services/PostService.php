<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PostContract;

class PostService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PostContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


    public function createPost($request, $fileType, $path = '')
    {
        $post = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $fileType, $post, $path);
        return $post;
    }

    public function updatePost($modelObject, $request, $type, $path = '')
    {
        $post = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type, $path, $request['image'] ?? '');
        return $post;
    }
}
