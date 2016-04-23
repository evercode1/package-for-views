<?php

namespace Evercode1\ViewMaker;

use Illuminate\Support\ServiceProvider;

/**
 * This is the service provider.
 *
 * Place the line below in the providers array inside app/config/app.php
 *  Evercode1\ViewMaker\src\ViewMakerServiceProvider::class,
 *
 * @package view-maker
 * @author Bill Keck
 *
 **/

class ViewMakerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * The console commands.
     *
     * @var bool
     */
    protected $commands = [
        'Evercode1\ViewMaker\MakeViews',
        'Evercode1\ViewMaker\MakeCrud',
        'Evercode1\ViewMaker\MakeAll',
    ];


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['view-maker'];
    }
}