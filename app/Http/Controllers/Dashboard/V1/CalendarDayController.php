<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Services\Hijri;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\CalendarDayRequest;
use App\Http\Resources\CalendarDayResource;
use App\Models\CalendarDay;
use App\Services\CalendarDayService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
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
        $this->relations = ['clinic'];
        parent::__construct($service, CalendarDayResource::class);
    }

    /**
     * Calendar Days List
     * Filtered by month and year
     * @response {"data":[{"clinic":{"id":1,"name":"Clinic 1","number_of_doctors":5,"duration":30,"created_at":"2024-07-10 19:27:39","updated_at":"2024-07-10 19:27:39","shift_type":1,"location":"Location 1","start_time":"08:00:00","end_time":"16:00:00"},"id":1,"created_at":null,"updated_at":null,"day_date":"1446-01-17","clinic_id":1}],"status":200}
     */
    public function list(): mixed
    {
        $hijriDate = Hijri::Date('Y-m');
        request()->merge([
            'page' => false,
            'limit' => false,
            'month' => request('month', $hijriDate),
        ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Calendar Days enable
     * @bodyParam dates array required The dates to enable Example: ["2022-01-01", "2022-01-02"]
     * @bodyParam clinic_id integer required The clinic id Example: 1
     * @response {}
     */
    public function enableDays(CalendarDayRequest $request): JsonResponse
    {
        $this->service->enableDays($request->validated());
        return $this->respondWithSuccess();
    }

    /**
     * Calendar Days disable
     * @bodyParam dates array required The dates to enable Example: ["2022-01-01", "2022-01-02"]
     * @bodyParam clinic_id integer required The clinic id Example: 1
     * @response {}
     */
    public function disableDays(CalendarDayRequest $request): JsonResponse
    {
        $this->service->disableDays($request->validated());
        return $this->respondWithSuccess();
    }
}
