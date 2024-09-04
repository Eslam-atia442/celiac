<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\CalendarDayRequest;
use App\Http\Resources\CalendarDayResource;
use App\Models\CalendarDay;
use App\Services\CalendarDayService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
 * @subgroup CalendarDay
 */
class CalendarDayController extends BaseApiController
{
    /**
     * CalendarDayController constructor.
     * @param CalendarDayService $service
     */


    public function __construct(CalendarDayService $service)
    {
        $this->service = $service;
        parent::__construct($service, CalendarDayResource::class);
    }

    /**
     * Calendar Days List
     * Filtered by month and year
     * @response {}
     */
    public function list(CalendarDayRequest $request): mixed
    {

        $data = $request->validated();
//        $defaultMonth = $data['month'] ?? date('m');
        request()->merge([
            'page' => false,
            'limit'=> false,
//            'month' => request('month', $defaultMonth),
            'dayDate' => $data['day_date'],
            'clinic' => $data['clinic_id']
        ]);


        $models = $this->service->search([], $this->relations);

        return $this->respondWithCollection($models);
    }


}
