<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/31/17
 * Time: 10:20 AM
 */

namespace PluginHttpClientPassportLaravel\Laravel;

use Illuminate\Support\ServiceProvider;
use PluginHttpClientPassportLaravel\ServiceContainer;

class HttpClientPassportServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('HttpClientPassportLaravel', function ($app) {
            /** @var \PluginHttpClientPassportLaravel\Client $httpClientPassportLaravel */
            $httpClientPassportLaravel =  ServiceContainer::getInstance()
                ->getContainer()
                ->get('HttpClientPassportLaravel');

            return $httpClientPassportLaravel;
        });
    }
    public function provides()
    {
        return ['HttpClientPassportLaravel'];
    }
}