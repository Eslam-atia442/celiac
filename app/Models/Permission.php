<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use ModelTrait;

    public const ADDITIONAL_PERMISSIONS = [];
    protected static mixed $abilities;
    protected static mixed $models;
    protected static mixed $permissions;
    protected array $filters = [];

    public const PERMISSIONS_NOT_APPLIED = true;

    public static function defaultPermissions(): array
    {
        self::$permissions = [];
        self::$abilities = collect(['create', 'read', 'update', 'delete']);
        $modelFiles = Storage::disk('app')->files('Models');
        self::$models = collect($modelFiles)->map(function ($modelFile) {
            $model = str_replace('.php', '', $modelFile);
            $model = str_replace('Models/', '', $model);
            $modelClass = 'App\\Models\\' . str_replace('/', '\\', $model);
            self::$abilities->map(function ($ability) use ($model, $modelClass) {
                if (!defined("$modelClass::PERMISSIONS_NOT_APPLIED") || !$modelClass::PERMISSIONS_NOT_APPLIED) {
                    $perm = $ability . Str::lower(implode('-', preg_split('/(?=[A-Z])/', $model)));
                    self::$permissions[] = ['name' => $perm, 'action' => $ability, 'model' => $model, 'guard_name' => 'sanctum'];
                }
            });
            if (defined("$modelClass::ADDITIONAL_PERMISSIONS")) {
                if (!defined("$modelClass::PERMISSIONS_NOT_APPLIED") || !$modelClass::PERMISSIONS_NOT_APPLIED) {
                    foreach ($modelClass::ADDITIONAL_PERMISSIONS as $additionalPermission) {
                        self::$permissions[] = [
                            'name' => $additionalPermission,
                            'action' => Str::replace('-', ' ', $additionalPermission),
                            'model' => $model,
                            'guard_name' => 'sanctum'
                        ];
                    }
                }
            }

            if (defined("$modelClass::ADDITIONAL_OTHER_PERMISSIONS")) {
                foreach ($modelClass::ADDITIONAL_OTHER_PERMISSIONS as $key => $additionalPermission) {
                    foreach ($additionalPermission as $perm) {
                        self::$permissions[] = [
                            'name' => $perm . Str::lower(implode('-', preg_split('/(?=[A-Z])/', $key))),
                            'action' => Str::replace('-', ' ', $perm),
                            'model' => $key,
                            'guard_name' => 'sanctum'];
                    }
                }
            }
        });
        return self::$permissions;
    }
}
