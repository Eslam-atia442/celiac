<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\NewsContract;

class NewsService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(NewsContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        $news = $this->repository->create($request);
        if (array_key_exists('image', $request)) {
            app(FileService::class)->createFile($request['image'], $request, FileEnum::file_type_news_image->value, $news, 'news');
        }
        return $news;
    }

    public function update($modelObject, $request)
    {
        $news = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, FileEnum::file_type_news_image->value, 'news', $request['image'] ?? '');
        return $news;
    }
}
