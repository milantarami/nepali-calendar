<?php

// namespace MilanTarami\NepaliCalendar\Tests;

use Illuminate\Support\Facades\Blade;
use Orchestra\Testbench\TestCase;

class CustomBaldeDirectiveTest extends TestCase
{

    /** @test */
    public function testDateBSBladeDirective()
    {
        $expected = '<?php echo NepaliCalendar::today(); ?>';
        $actual = Blade::compileString('@dateBS');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testAD2BSBladeDirective()
    {
        $expected = '<?php echo \MilanTarami\NepaliCalendar\Facades\NepaliCalendar::AD2BS(); ?>';
        $actual = Blade::compileString('@AD2BS');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testBS2ADBladeDirective()
    {
        $expected =  '<?php echo \MilanTarami\NepaliCalendar\Facades\NepaliCalendar::BS2AD(); ?>';
        $actual = Blade::compileString('@BS2AD');
        $this->assertEquals($expected, $actual);
    }

    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app)
    {
        return [
            'MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider',
        ];
    }
}
