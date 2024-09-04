<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\CeliacCardContract;

class CeliacCardService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(CeliacCardContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


    public function getMyCeliacCard()
    {
        $user = auth()->user();
        if ($user->approveCeliacCard) {
            return $user->approveCeliacCard;
        }
        return false;
    }

    public function create($request)
    {
        $response = [];
        $user = auth()->user();

        if ($user->approveCeliacCard) {
            return $response = [ 'message' => __('messages.validation.your_have_already_celiac_card'), 'status' => 400 ];
        }

        if ($user->pendingCeliacCard) {
            return $response = [ 'message' => __('messages.validation.you_have_already_pending_celiac_card'), 'status' => 400 ];
        }

        $request['user_id'] = $user->id;
        $response = $this->repository->create($request);

        if (array_key_exists('medical_report', $request)) {
            app(FileService::class)->createFile($request['medical_report'], $request, FileEnum::file_type_celiac_card_medical_report->value, $response, 'patient_celiac_medical_reports');
        }
        return $response;
    }
}
