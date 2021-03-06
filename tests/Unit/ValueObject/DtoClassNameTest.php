<?php

namespace Tests\Gugunso\LaravelNotificationTemplate\ValueObject;

use Gugunso\LaravelNotificationTemplate\ValueObject\ClassName;
use Gugunso\LaravelNotificationTemplate\ValueObject\DriverName;
use Gugunso\LaravelNotificationTemplate\ValueObject\DtoClassName;
use Gugunso\LaravelNotificationTemplate\ValueObject\NotificationChannel;
use Orchestra\Testbench\TestCase;

/**
 * @coversDefaultClass \Gugunso\LaravelNotificationTemplate\ValueObject\DtoClassName
 * Tests\Gugunso\LaravelNotificationTemplate\ValueObject\DtoClassNameTest
 */
class DtoClassNameTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = DtoClassName::class;

    /**
     * @coversNothing
     */
    public function test___construct()
    {
        $targetClass = new $this->testClassName('');
        $this->assertInstanceOf(ClassName::class, $targetClass);
    }

    /**
     * @covers ::setValue
     */
    public function test_setValue_Default()
    {
        $targetClass = new $this->testClassName('');
        $this->assertSame(\stdClass::class, $targetClass->getValue());
    }

    /**
     * @coversNothing
     */
    public function test_serialize()
    {
        $targetClass = new $this->testClassName('');
        try {
            serialize($targetClass);
            //OK
            $this->assertTrue(true);
        } catch (\Throwable $e) {
            //必ず失敗するAssertion
            $this->assertTrue(false, $e->getMessage());
        }
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
