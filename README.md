# Number to words

## Installation and setup

You can install this package via composer using:

``` bash
composer require milantarami/nepali-calendar
```

The package will automatically register its service provider for laravel 5.5.* and above. <br>
For below version need to register a service provider manually in <code>config/app.php</code>

``` bash
'providers' => [

    /*
    * Package Service Providers...
    */
    
   MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider::class         

],
```

The package will automatically load alias for laravel 5.5.* and above. <br>
For below version need to add alias manually in <code>config/app.php</code>

``` bash
'aliases' => [
    .
    .
    'NumberToWords' => MilanTarami\NepaliCalendar\Facades\NepaliCalendar::class,

]
```

To publish the config file to <code>config/number_to_words.php</code> run:

``` bash
php artisan vendor:publish --tag=nepali-calendar-config
```

This is the default contents of the configuration:


##  Basic Usage

``` bash
echo NumberToWords::get(123456789);

//output : Twelve Crore Thirty-four Lakh Fifty-six Thousand Seven Hundred Eighty-nine Rupees and Twelve Paisa

```

## Usage with config as optional paramater

### Example 1

