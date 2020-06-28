<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            $db = DB::table('instances')->select('host', 'key')->where('active', 1)->first();
            Log::debug('db', ['db' => $db]);
            try {
                return new Client($db->host, $db->key);
            } catch (\Exception $e) {
                report($e);
                throw new \Exception('Could not connect to meilisearch');
            }
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
