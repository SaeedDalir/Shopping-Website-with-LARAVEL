<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user,$ability,$params){
            if ($user->isAdmin()){
                return true;
            }
        });

        Gate::define('is_seller',function ($user){
            return $user->isSeller();
        });

        Gate::define('is_user',function ($user){
            return $user->isUser();
        });
    }
}
