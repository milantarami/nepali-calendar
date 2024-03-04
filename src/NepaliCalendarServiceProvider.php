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
        $this->mergeConfigFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'nepali-calendar.php', 'nepali-calendar');
        $this->mergeConfigFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'en'.DIRECTORY_SEPARATOR.'nepali-calendar.php', 'nepali-calendar');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang', 'nepali-calendar');

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
            $this->publishes([__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'nepali-calendar.php' => config_path('nepali-calendar.php')], 'nepali-calendar-config');

            $this->publishes([
                __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang' => resource_path('lang')
            ], 'nepali-calendar-validation');
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
