<?php

namespace App\Providers;

use App\User;
use App\Review;
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

        Gate::define('poster', function(User $user, Review $review) {
        return $user->id==$review->user_id;
        });
        
        Gate::define('admin', function(User $user) {
        return $user->id==1;
        });
    }
}
