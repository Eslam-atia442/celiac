<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Services\ReservationService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Reservation
 */

class ReservationController extends BaseApiController
{
     /**
        * ReservationController constructor.
        * @param ReservationService $service
        */


       public function __construct(ReservationService $service)
       {
           $this->service = $service;
           parent::__construct($service, ReservationResource::class);
       }


   /**
    * Display the specified resource.
    * @param Reservation $reservation
    * @return JsonResponse
    */
   public function show(Reservation $reservation): JsonResponse
   {
       try {
           return $this->respondWithModel($reservation->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param ReservationRequest $request
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function update(ReservationRequest $request, Reservation $reservation) : JsonResponse
    {
        try {
            $reservation = $this->service->update($reservation, $request->validated());
            return $this->respondWithModel($reservation->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param Reservation $reservation
     * @return JsonResponse
     */


    /**
     * Cancel Reservation
     *
     *
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *   }
     * }
     *
     */

    public function cancel( Reservation $reservation)
    {
        $model = $this->service->cancel($reservation);
        return $this->respondWithModel($model);

    }
}
