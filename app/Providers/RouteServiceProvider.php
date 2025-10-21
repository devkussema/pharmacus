<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')->group(function () {
                Route::group([], base_path('routes/web.php'));
                Route::group([], base_path('routes/mail.php'));
                Route::group([], base_path('routes/gerente.php'));
                Route::prefix('ocorrencias')->as('ocorrencia.')->group(base_path('core/routes/ocorrencia.php'));
                Route::prefix('preview/v3')->as('preview.')->group(base_path('routes/preview.php'));
                Route::prefix('cp')->as('cp.')->group(app_path('Routes/cp.php'));
            });
        });
    }
}
