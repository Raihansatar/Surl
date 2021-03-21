<?php

namespace App\Providers;

use App\Interfaces\Url\UrlInterface;
use App\Repositories\Url\UrlRepository;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UrlInterface::class,
            UrlRepository::class
        );
        // dd("aweaew");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
