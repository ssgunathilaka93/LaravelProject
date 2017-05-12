<?php

namespace Backpack\Settings;

use Backpack\Settings\app\Models\Setting as Setting;
use Config;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Route;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // only use the Settings package if the Settings table is present in the database
        if (!\App::runningInConsole() && count(Schema::getColumnListing('settings'))) {
            // get all settings from the database
            $settings = Setting::all();

            // bind all settings to the Laravel config, so you can call them like
            // Config::get('settings.contact_email')
            foreach ($settings as $key => $setting) {
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }
        // publish the migrations and seeds
        $this->publishes([__DIR__.'/database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/database/seeds/' => database_path('seeds')], 'seeds');

        // publish translation files
        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/backpack')], 'lang');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Backpack\Settings\app\Http\Controllers'], function ($router) {
            // Admin Interface Routes
            Route::group(['prefix'   => config('backpack.base.route_prefix', 'admin'),
                        'middleware' => ['web', 'admin'], ], function () {
                            // Settings
                            Route::resource('setting', 'SettingCrudController');
                        });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSettings();
        $this->setupRoutes($this->app->router);
    }

    private function registerSettings()
    {
        $this->app->bind('settings', function ($app) {
            return new Settings($app);
        });
    }
}
