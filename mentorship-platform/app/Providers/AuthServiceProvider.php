<?php

namespace App\Providers;

use App\Models\MentorshipRequest;
use App\Policies\MentorshipRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        MentorshipRequest::class => MentorshipRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define role-based gates
        Gate::define('is-mentor', function ($user) {
            return $user->role === 'mentor';
        });

        Gate::define('is-startup', function ($user) {
            return $user->role === 'startup';
        });
    }
} 