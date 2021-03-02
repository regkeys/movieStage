<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *  Define GATES
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //Define your GATE Here  - can call it anything you like ie. manage-users
        Gate::define('manage-users', function ($user){
            return $user->hasAnyRoles(['admin', 'viewOnlyAdmin']);
        });

        //Define your GATE Here  - can call it anything you like ie. edit-users
        Gate::define('edit-users', function ($user){
            return $user->hasRole('admin');
        });

        //Define your GATE Here  - can call it anything you like ie. delete-users
        Gate::define('delete-users', function ($user){
            return $user->hasRole('admin');
        });
    }

}
