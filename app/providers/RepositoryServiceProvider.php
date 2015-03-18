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
             'App\Repositories\ProjectContactRepository',
             'App\Repositories\EloquentProjectContactRepository'
        );
        $this->app->bind(
            'App\Repositories\DonorRepository',
            'App\Repositories\EloquentDonorRepository'
        );
        $this->app->bind(
            'App\Repositories\VolunteerHoursRepository',
            'App\Repositories\EloquentVolunteerHoursRepository'
        );
        $this->app->bind(
            'App\Repositories\FamilyContactRepository',
            'App\Repositories\EloquentFamilyContactRepository'
        );
        $this->app->bind(
            'App\Repositories\FamilyRepository',
            'App\Repositories\EloquentFamilyRepository'
        );
        $this->app->bind(
            'App\Repositories\ProjectInspectionRepository',
            'App\Repositories\EloquentProjectInspectionRepository'
        );
        
        $this->app->bind(
            'App\Repositories\ProjectItemRepository',
            'App\Repositories\EloquentProjectItemRepository'
        );
        
        $this->app->bind(
            'App\Repositories\ProjectRolesRepository',
            'App\Repositories\EloquentProjectRolesRepository'
        );
    }
}
