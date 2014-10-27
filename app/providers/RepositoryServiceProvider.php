<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\ContactRepository',
            'App\Repositories\EloquentContactRepository'
        );
    }
}
