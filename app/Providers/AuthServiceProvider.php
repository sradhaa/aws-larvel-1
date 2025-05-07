<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,  // Register Policy
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


 // Admin Gate
 Gate::define('is-admin', function (User $user) {

   
    return $user->role === 'admin';
});

// Editor Gate
Gate::define('is-editor', function (User $user) {
    return $user->role === 'editor';
});

// User Gate
Gate::define('is-user', function (User $user) {
    return $user->role === 'user';
});


        
    }
}
