<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->getModels() as $model) {
            $this->app->bind(
                "App\Repositories\Contracts\\{$model}Contract",
                "App\Repositories\SQL\\{$model}Repository"
            );
        }

        // For setting 
        $this->app->bind(
            "App\Repositories\Contracts\\SettingContract",
            "App\Repositories\SQL\\SettingRepository"
        );
    }

    protected function getModels(): Collection
    {
        $files = Storage::disk('app')->files('Models');
        return collect($files)->map(function ($file) {
            return basename($file, '.php');
        });
    }
}
