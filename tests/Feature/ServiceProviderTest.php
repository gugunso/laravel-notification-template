<?php

namespace Gugunso\LaravelNotificationTemplate\Tests\Feature;

use Gugunso\LaravelNotificationTemplate\Exceptions\ConfigFileNotFoundException;
use Gugunso\LaravelNotificationTemplate\Repository\Contracts\NotificationSettingRepository;
use Gugunso\LaravelNotificationTemplate\ServiceProvider;
use Gugunso\LaravelNotificationTemplate\Test\TestCase;
use Illuminate\Support\Facades\App;

/**
 * @coversDefaultClass \Gugunso\LaravelNotificationTemplate\ServiceProvider
 * Gugunso\LaravelNotificationTemplate\Tests\Feature\ServiceProviderTest
 */
class ServiceProviderTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = ServiceProvider::class;

    /**
     * @covers ::register
     * @covers ::boot
     */
    public function test_()
    {
        $this->expectException(ConfigFileNotFoundException::class);
        $this->artisan('notification-template:config-check')->assertExitCode(20);
        $this->artisan('notification-template:list')->assertExitCode(1);
    }

}
