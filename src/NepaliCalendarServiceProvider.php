<?php

namespace MilanTarami\NepaliCalendar;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class NepaliCalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'./../config/nepali-calendar.php', 'nepali-calendar');
        $this->mergeConfigFrom(__DIR__.'./../resources/lang/en/nepali-calendar.php', 'nepali-calendar');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nepali-calendar');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nepali-calendar');

        $this->app->bind(
            'MilanTarami\NepaliCalendar\Contracts\NepaliCalendarInterface',
            'MilanTarami\NepaliCalendar\NepaliCalendar'
        );

        $this->app->bind('nepalicalendar', function () {
            return new NepaliCalendar();
        });

        AliasLoader::getInstance()->alias('NepaliCalendar', 'MilanTarami\NepaliCalendar\Facades\NepaliCalendar');

        $this->configureCustomValidationRules();
        $this->configureCustomBladeDirectives();
        $this->configurePublishing();
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'./../config/nepali-calendar.php' => config_path('nepali-calendar.php')], 'nepali-calendar-config');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/'),
            ], 'nepali-calendar-validation');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/nepali-calendar'),
            ], 'nepali-calendar-views');
        }
    }

    /**
     * Configure custom blade directives.
     *
     * @return void
     */
    public function configureCustomBladeDirectives()
    {
        Blade::directive('dateBS', function () {
            return '<?php echo NepaliCalendar::today(); ?>';
        });

        Blade::directive('AD2BS', function ($dateAD) {
            return "<?php echo \MilanTarami\NepaliCalendar\Facades\NepaliCalendar::AD2BS($dateAD); ?>";
        });

        Blade::directive('BS2AD', function ($dateBS) {
            return "<?php echo \MilanTarami\NepaliCalendar\Facades\NepaliCalendar::BS2AD($dateBS); ?>";
        });
    }

    /**
     * Configure custom validation rules for the package.
     *
     * @return void
     */
    public function configureCustomValidationRules()
    {
        Validator::extend(
            'date_bs',
            function ($attribute, $value, $params, $validator) {
                try {
                    $nepaliCalendar = new NepaliCalendar();

                    return $nepaliCalendar->bsDateExists($value);
                } catch (\Exception $e) {
                    return false;
                }
            },
            __('nepali-calendar.invalid_date_bs')
        );
    }
}
