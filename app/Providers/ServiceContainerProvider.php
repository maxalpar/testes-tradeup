<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Components\Containers\RepositoryContainer;
use App\Domain\Components\Containers\ServiceContainer;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class ServiceContainerProvider extends ServiceProvider
{
    public function boot()
    {
        $serviceContainer = $this->app[ServiceContainer::class];

        $directory   = app_path() . DIRECTORY_SEPARATOR . 'Domain' . DIRECTORY_SEPARATOR . 'Services';
        $files       = File::allFiles($directory);
        $notInstance = ['ServiceAbstract.php'];
        foreach ($files as $file) {
            if (!in_array($file->getFilename(), $notInstance)) {
                $path = 'App\Domain\Services\\' . $file->getFilename();
                if ($file->getRelativePath() != "") {
                    $path = 'App\Domain\Services\\' . $file->getRelativePath() . '\\' . $file->getFilename();
                }
                $class = new ReflectionClass(str_replace('.php', '', $path));
                $serviceContainer->addService($class->newInstanceArgs([$this->app[RepositoryContainer::class]]));
            }
        }
    }

    public function register()
    {
        $this->app->singleton(ServiceContainer::class, function () {
            return new ServiceContainer();
        });
    }
}
