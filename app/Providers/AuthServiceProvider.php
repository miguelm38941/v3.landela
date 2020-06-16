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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::Define('is-admin', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('is-medecin', function($user){
            return $user->hasAnyRole('ROLE_MEDECIN');
        });
        Gate::Define('register-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('activate-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('delete-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('approve-registration', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('view-user-requests', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('delete-user-requests', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('reset-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('display-users', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('view-pvv', function($user){
            return $user->hasAnyRole(['ROLE_ADMIN', 'ROLE_AGENT', 'ROLE_MEDECIN']);
        });
        Gate::Define('activate-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('delete-user', function($user){
            return $user->hasAnyRole('ROLE_ADMIN');
        });
        Gate::Define('consultation-view', function($user){
            return $user->hasAnyRole(['ROLE_ADMIN', 'ROLE_AGENT', 'ROLE_INFIRMIER', 'ROLE_MEDECIN']);
            //return $user->hasAnyRole(['ROLE_AGENT']);
        });
        Gate::Define('consultation-update', function($user){
            return $user->hasAnyRole('ROLE_ADMIN', 'ROLE_AGENT');
        });
        Gate::Define('consultation-delete', function($user){
            return $user->hasAnyRole('ROLE_ADMIN', 'ROLE_AGENT');
        });
        Gate::Define('diagnostic', function($user){
            return $user->hasAnyRole(['ROLE_ADMIN', 'ROLE_MEDECIN']);
        });
        Gate::Define('exams_view', function($user){
            return $user->hasAnyRole(['ROLE_ADMIN', 'ROLE_PVV', 'ROLE_MEDECIN', 'ROLE_LABORANTIN']);
        });
        Gate::Define('ordonnances_view', function($user){
            return $user->hasAnyRole(['ROLE_ADMIN', 'ROLE_PVV', 'ROLE_MEDECIN', 'ROLE_PREPOSE']);
        });

    }

}
