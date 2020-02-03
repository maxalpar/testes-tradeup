<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Components\Containers\RepositoryContainer;
use Illuminate\Support\Facades\File;

class RepositoryContainerProvider extends ServiceProvider
{
    public function boot()
    {
        $repositoryContainer = $this->app[RepositoryContainer::class];

        $directory = app_path() . DIRECTORY_SEPARATOR . 'Domain' . DIRECTORY_SEPARATOR . 'Repositories';

        $files = File::allFiles($directory);
        $notInstance = ['RepositoryAbstract.php', 'RepositoryInterface.php'];
        foreach ($files as $file) {
            if (!in_array($file->getFilename(), $notInstance)) {
                $class = 'App\Domain\Repositories\\' .
                    //str_replace(['/', '\\'], '\\', $file->getRelativePath()) . '\\' . $file->getFilename();
                    str_replace(['/', '\\'], '\\', $file->getRelativePath()) . $file->getFilename();
                $repository = str_replace('.php', '', $class);
                $repositoryContainer->addRepository($repository);
            }
        }
    }

    public function register()
    {
        $this->app->singleton(RepositoryContainer::class, function () {
            return new RepositoryContainer();
        });
    }
}
