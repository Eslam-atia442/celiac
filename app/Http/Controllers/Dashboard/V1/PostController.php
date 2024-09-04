<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Post
 */
class PostController extends BaseApiController
{
    public string $type;
    public string $path;
    /**
     * PostController constructor.
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
        $this->relations = ['image'];
        $this->type = FileEnum::file_type_post_image->value;
        $this->path = config('filesystems.upload.paths.post');
        parent::__construct($service, PostResource::class, 'post');
    }

    /**
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        try {
            $post = $this->service->createPost($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($post->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param Post $post
     * @queryParam scope string
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        try {
            return $this->respondWithModel($post->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        try {
            $post = $this->service->updatePost($post, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($post->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        try {
            $this->service->remove($post);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Post $post
     * @return JsonResponse
     */
    public function changeActivation(Post $post): JsonResponse
    {
        try {
            $this->service->toggleField($post, 'is_active');
            return $this->respondWithModel($post->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
