<?php

namespace App\Providers;

use App\Http\Middleware\AuthorizeChannelWithoutAuthentication;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Broadcast::routes(['middleware' => 'auth:sanctum']);



        require base_path('routes/channels.php');
    }
}
