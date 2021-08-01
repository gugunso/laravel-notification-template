<?php

namespace Gugunso\LaravelNotificationTemplate\Tests\Feature\Command;

use Gugunso\LaravelNotificationTemplate\Command\TemplateList;
use Gugunso\LaravelNotificationTemplate\DataTransferObject\AllSetting;
use Gugunso\LaravelNotificationTemplate\Service\Command\TemplateListService;
use Gugunso\LaravelNotificationTemplate\Test\TestCase;
use Illuminate\Support\Facades\App;


/**
 * @coversDefaultClass \Gugunso\LaravelNotificationTemplate\Command\TemplateList
 * Gugunso\LaravelNotificationTemplate\Tests\Feature\Command\TemplateListTest
 */
class TemplateListTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = TemplateList::class;


    /**
     * @covers ::handle
     * @covers ::init
     */
    public function test_handle()
    {
        //正常に実行できる条件を整えたテスト
        $stubDto = \Mockery::mock(AllSetting::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $stubDto->shouldReceive('toArray')->andReturn(
            []
        );

        $stubService = \Mockery::mock(TemplateListService::class)->shouldIgnoreMissing();
        $stubService->shouldReceive('getDto')->andReturn($stubDto);

        App::shouldReceive('make')
            ->with(TemplateListService::class)
            ->once()
            ->andReturn($stubService);

        App::makePartial();

        $this->artisan('notification-template:list')->assertExitCode(0);
    }

    /**
     * @covers ::handle
     */
    public function test_handle_RaiseException(){
        $this->artisan('notification-template:list')->assertExitCode(1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
