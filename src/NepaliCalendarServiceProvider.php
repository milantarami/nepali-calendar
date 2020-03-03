<?php

namespace MilanTarami\NepaliCalendar;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use MilanTarami\NepaliCalendar\Contracts\NepaliCalendarInterface;
use MilanTarami\NepaliCalendar\NepaliCalendar;

class NepaliCalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__. './../config/nepali-calendar.php', 'nepali-calendar');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([ __DIR__.'./../config/nepali-calendar.php' => config_path('nepali-calendar.php'), ], 'nepali-calendar-config');
        }

        $this->app->bind(
            'MilanTarami\NepaliCalendar\Contracts\NepaliCalendarInterface',
            'MilanTarami\NepaliCalendar\NepaliCalendar'
        );

        $this->app->bind('nepalicalendar', function () {
            return new NepaliCalendar();
        });



        AliasLoader::getInstance()->alias('NepaliCalendar', 'MilanTarami\NepaliCalendar\Facades\NepaliCalendar');
    }
}
