<?php

namespace App\Providers;
use Laravel\Passport\Passport;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    
        // Passport::routes();
    
        // Define your Passport routes here:
        Route::group([
            'prefix' => 'oauth',
            'namespace' => '\Laravel\Passport\Http\Controllers',
            'middleware' => ['web'],
        ], function () {
            Route::post('/authorize', [
                'as' => 'passport.authorizations.authorize',
                'uses' => 'AuthorizationController@authorize',
            ]);
    
            // ... Add other Passport routes as needed ...
    
            Route::post('/token', [
                'as' => 'passport.token',
                'uses' => 'AccessTokenController@issueToken',
            ]);
        });
}
}
