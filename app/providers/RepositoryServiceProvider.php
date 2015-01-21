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
        $this->app->bind(
            'App\Repositories\DonorRepository',
            'App\Repositories\EloquentDonorRepository'     
        );
        $this->app->bind(   
            'App\Repositories\CompanyRepository',
            'App\Repositories\EloquentCompanyRepository');
        
        $this->app->bind(
            'App\Repositories\VolunteerRepository',
            'App\Repositories\EloquentVolunteerRepository'
        );
        $this->app->bind(
            'App\Repositories\ProjectRepository',
            'App\Repositories\EloquentProjectRepository'
        );
        $this->app->bind(
            'App\Repositories\DonorRepository',
            'App\Repositories\EloquentDonorRepository'
        );
        $this->app->bind(
<<<<<<< HEAD
            'App\Repositories\VolunteerHoursRepository',
            'App\Repositories\EloquentVolunteerHoursRepository'
            'App\Repositories\FamilyRepository',
            'App\Repositories\EloquentFamilyRepository'
        );
        $this->app->bind(
            'App\Repositories\FamilyContactRepository',
            'App\Repositories\EloquentFamilyContactRepository'
>>>>>>> 6b16273d9ac310a2d8f21a65d80c76044a758707
        );
    }
}
