<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Models\GeneralSettings;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\HajjRequestContract;

class HajjRequestService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(HajjRequestContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        $response = [];
        $user = auth()->user();

        if ($user->pendingHajjRequest) {
            return $response = [ 'message' => __('messages.validation.you_have_already_pending_job_request'), 'status' => 400 ];
        }
        $request['user_id'] = $user->id;
        $response = $this->repository->create($request);
        if (array_key_exists('file', $request)) {
            app(FileService::class)->createFile($request['cv'], $request, FileEnum::file_type_hajj_request->value, $response, 'hajj');
        }
        return $response;
    }

    public function changeSettings(): void
    {
        $generalSetting = new GeneralSettings();
        $generalSetting->apply_for_hajj = !$generalSetting->apply_for_hajj;
        $generalSetting->save();
    }
}
