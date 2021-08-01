<?php

namespace Gugunso\LaravelNotificationTemplate\Test;

/**
 * Class TestCase
 * @package Gugunso\LaravelNotificationTemplate\Test
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [\Gugunso\LaravelNotificationTemplate\ServiceProvider::class];
    }

}