<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        $this->app->singleton('meili', function () {
            $db = DB::table('instances')->select('host', 'key')->where('active', 1)->first();
            return new Client($db->host, $db->key);
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
