<?php

namespace App\Providers;
use App\Models\TaskSheet;
use App\Policies\TaskPolicy;
use App\Models\Attendance;
use App\Models\User;
use App\Policies\AttendancePolicy;
use App\Policies\ModelPolicy;
use Laravel\Passport\Passport;
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
        TaskSheet::class => TaskPolicy::class,
        Attendance::class => AttendancePolicy::class,
        // User::class => ModelPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
            // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');

        }

    }
}
