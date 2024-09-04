<?php

namespace App\Repositories\SQL;

use App\Models\CalendarDay;
use App\Repositories\Contracts\CalendarDayContract;

class CalendarDayRepository extends BaseRepository implements CalendarDayContract
{
    /**
     * CalendarDayRepository constructor.
     * @param CalendarDay $model
     */
    public function __construct(CalendarDay $model)
    {
        parent::__construct($model);
    }

    public function enableDays(array $data): void
    {
        foreach ($data['dates'] as $date) {
            $this->model->updateOrCreate([
                'day_date' => $date,
                'clinic_id' => $data['clinic_id'],
            ]);
        }
    }

    public function disableDays(array $data): void
    {
        $this->model->whereIn('day_date', $data['dates'])->where('clinic_id', $data['clinic_id'])->delete();
    }
}
