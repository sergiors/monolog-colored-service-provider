<?php

namespace Sergiors\Silex\Tests\Provider;

use Pimple\Container;
use Silex\Provider\MonologServiceProvider;
use Sergiors\Silex\Provider\MonologColoredServiceProvider;
use Bramus\Monolog\Formatter\ColoredLineFormatter;

class MonologColoredServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function register()
    {
        $app = $this->createApplication();
        $app->register(new MonologServiceProvider(), [
            'monolog.logfile' => 'php://stdout'
        ]);
        $app->register(new MonologColoredServiceProvider());

        $this->assertInstanceOf(ColoredLineFormatter::class, $app['monolog.formatter']);
    }

    public function createApplication()
    {
        return new Container();
    }
}
