<?php
namespace App\Traits;

trait ActivityLogTrait{

    public function logActivity($model,$user,$message): void
    {
        activity()
            ->performedOn($model)
            ->causedBy($user)
            ->log($message);
    }

    public function propertyLogActivity($model, $user, $message, array $property=['key' => 'value']): void
    {
        activity()
            ->performedOn($model)
            ->causedBy($user)
            ->withProperties($property)
            ->log($message);
    }

    public function customLogOnUpdateFields($filtered, $model)
    {
        $old = $model->getAttributes();
        $old = collect($old)->map(function ($value) {
            if (is_array($value))
                $value = json_encode($value);
            return $value;
        })->toArray();
        $filtered = collect($filtered)->map(function ($value) {
            if (is_array($value))
                $value = json_encode($value);
            return $value;
        })->toArray();
        $changes = array_diff_uassoc($filtered, $old, function ($a, $b) {
            return $a == $b ? 0 : 1;
        });
        if (count($changes) && (!defined("$model::DISABLE_LOG") || !$model::DISABLE_LOG)) {
            $changes = collect($changes)->map(function ($item, $key) use ($old, $filtered, $model) {
                if (in_array($key, array_keys($model->getCasts())) && preg_match("/\bConstants\b/i", $model->getCasts()[$key])) {
                    $old[$key] = $model->getCasts()[$key]::getLabels()[$old[$key]];
                    $filtered[$key] = $model->getCasts()[$key]::getLabels()[$filtered[$key]];
                }
                return [
                    'field' => $key,
                    'old' => $old[$key],
                    'new' => $filtered[$key]
                ];
            })->values()->toArray();
            $this->propertyLogActivity(
                $model,
                auth()->user(),
                "$this->modelName Updated",
                [
                    'action' => 'Update',
                    'changes' => $changes
                ]
            );
        }
        return $changes;
    }

}

 ?>
