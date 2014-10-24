<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of RepositoryServiceProvider
 *
 * @author cst222
 */
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
