<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MeiliSearch\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
 * @return void
     */
    public function register()
    {
        $this->app->bind('meili', function () {
            return new Client(config('meilisearch.host'), config('meilisearch.key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
