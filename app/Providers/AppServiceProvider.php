<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use App\Repositories\FirebaseAuthRepository;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Bind Firebase Factory
        $this->app->bind(Factory::class, function () {
            return (new Factory())->withServiceAccount(config('firebase.credentials.file'));
        });

        // Bind Firebase Auth
        $this->app->bind(Auth::class, function ($app) {
            return $app->make(Factory::class)->createAuth();
        });

        // Bind FirebaseAuthRepository
        $this->app->bind(FirebaseAuthRepository::class, function ($app) {
            return new FirebaseAuthRepository($app->make(Auth::class));
        });

        // Bind AuthService
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(FirebaseAuthRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
