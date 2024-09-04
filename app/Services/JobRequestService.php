<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Models\GeneralSettings;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\JobRequestContract;

class JobRequestService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(JobRequestContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        $response = [];
        $user = auth()->user();

        if ($user->pendingJobRequest) {
            return $response = [ 'message' => __('messages.validation.you_have_already_pending_job_request'), 'status' => 400 ];
        }

        $request['user_id'] = $user->id;
        $response = $this->repository->create($request);

        if (array_key_exists('cv', $request)) {
            app(FileService::class)->createFile($request['cv'], $request, FileEnum::file_type_job_request_cv->value, $response, 'cv');
        }
        return $response;
    }

    public function changeSettings(): void
    {

        $generalSetting = new GeneralSettings();
        $generalSetting->apply_for_jobs = !$generalSetting->apply_for_jobs;
        $generalSetting->save();
    }
}
