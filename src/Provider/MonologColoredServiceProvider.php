<?php

namespace Sergiors\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Bramus\Monolog\Formatter\ColoredLineFormatter;
use Bramus\Monolog\Formatter\ColorSchemes\TrafficLight;

final class MonologColoredServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app['monolog'])) {
            throw new \LogicException(
                'You must register the MonologColoredServiceProvider to use the MonologServiceProvider.'
            );
        }

        $app['monolog.formatter'] = $app->extend('monolog.formatter', function ($formatter) use ($app) {
            if ('php://stdout' === $app['monolog.logfile']) {
                return new ColoredLineFormatter(new TrafficLight());
            }

            return $formatter;
        });
    }
}
