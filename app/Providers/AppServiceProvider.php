<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use App\Services\FirebaseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Bind Guzzle HTTP Client
        $this->app->bind(ClientInterface::class, function () {
            return new Client();
        });

        // Bind Firebase Factory
        $this->app->bind(Factory::class, function () {
            return (new Factory())->withServiceAccount(config('firebase.credentials.file'));
        });

        // Bind Firebase Auth
        $this->app->bind(Auth::class, function ($app) {
            return $app->make(Factory::class)->createAuth();
        });

        // Bind FirebaseService with the Factory dependency
        $this->app->singleton(FirebaseService::class, function ($app) {
            return new FirebaseService($app->make(Factory::class));
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
