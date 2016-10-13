<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['frontend.*','welcome'], 'App\Http\ViewComposers\FrontendComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCantonService();
        $this->registerDistrictService();
        $this->registerAutoriteService();
        $this->registerCommuneService();
        $this->registerDonneeService();
        $this->registerCantonTribunauxService();

        $this->registerTribunauxService();
        $this->registerTribunauxDonneeService();

        $this->registerMenuService();
        $this->registerUploadService();
    }

    /**
     * Canton
     */
    protected function registerCantonService(){

        $this->app->singleton('App\Droit\Canton\Repo\CantonInterface', function()
        {
            return new \App\Droit\Canton\Repo\CantonEloquent(new \App\Droit\Canton\Entities\Canton);
        });
    }

    /**
     * Canton Tribunaux
     */
    protected function registerCantonTribunauxService(){

        $this->app->singleton('App\Droit\Canton\Repo\CantonTribunauxInterface', function()
        {
            return new \App\Droit\Canton\Repo\CantonTribunauxEloquent(
                new \App\Droit\Canton\Entities\Canton_tribunaux,
                new \App\Droit\Canton\Entities\Tribunal_deuxieme,
                new \App\Droit\Canton\Entities\Tribunal_premier
            );
        });
    }

    /**
     * District
     */
    protected function registerDistrictService(){

        $this->app->singleton('App\Droit\District\Repo\DistrictInterface', function()
        {
            return new \App\Droit\District\Repo\DistrictEloquent(new \App\Droit\District\Entities\District);
        });
    }

    /**
     * Autorite
     */
    protected function registerAutoriteService(){

        $this->app->singleton('App\Droit\Autorite\Repo\AutoriteInterface', function()
        {
            return new \App\Droit\Autorite\Repo\AutoriteEloquent(new \App\Droit\Autorite\Entities\Autorite);
        });
    }

    /**
     * Commune
     */
    protected function registerCommuneService(){

        $this->app->singleton('App\Droit\Commune\Repo\CommuneInterface', function()
        {
            return new \App\Droit\Commune\Repo\CommuneEloquent(new \App\Droit\Commune\Entities\Commune);
        });
    }

    /**
     *
     * Donnee
     */
    protected function registerDonneeService(){

        $this->app->singleton('App\Droit\Canton\Repo\DonneeInterface', function()
        {
            return new \App\Droit\Canton\Repo\DonneeEloquent(new \App\Droit\Canton\Entities\Canton_donnees);
        });
    }

    /**
     * Tribunaux
     */
    protected function registerTribunauxService(){

        $this->app->singleton('App\Droit\Tribunaux\Repo\TribunauxInterface', function()
        {
            return new \App\Droit\Tribunaux\Repo\TribunauxEloquent(new \App\Droit\Tribunaux\Entities\Tribunaux);
        });
    }

    /**
     * Tribunaux registerTribunauxDonneeService
     */
    protected function registerTribunauxDonneeService(){

        $this->app->singleton('App\Droit\Tribunaux\Repo\TribunauxDonneeInterface', function()
        {
            return new \App\Droit\Tribunaux\Repo\TribunauxDonneeEloquent(new \App\Droit\Tribunaux\Entities\Tribunaux_donnees);
        });
    }

    /**
     * Menu
     */
    protected function registerMenuService(){

        $this->app->singleton('App\Droit\Menu\Repo\MenuInterface', function()
        {
            return new \App\Droit\Menu\Repo\MenuEloquent(new \App\Droit\Menu\Entities\Menu);
        });
    }

    /*
   * Upload
   */
    protected function registerUploadService(){

        $this->app->bind('App\Service\UploadInterface', function()
        {
            return new \App\Service\UploadWorker();
        });
    }

}
