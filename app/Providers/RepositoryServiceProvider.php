<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Repositories\Contracts\EloquentRepositoryInterface',
            'App\Repositories\Eloquents\BaseRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\FacultyRepositoryInterface',
            'App\Repositories\Eloquents\FacultyRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\SubjectRepositoryInterface',
            'App\Repositories\Eloquents\SubjectRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\StudentRepositoryInterface',
            'App\Repositories\Eloquents\StudentRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquents\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\StudentSubjectRepositoryInterface',
            'App\Repositories\Eloquents\StudentSubjectRepository'
        );


    }
}
