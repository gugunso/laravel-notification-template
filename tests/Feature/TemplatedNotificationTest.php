<?php

namespace Gugunso\LaravelNotificationTemplate\Tests\Feature;

use Gugunso\LaravelNotificationTemplate\Entity\DummyNotifiable;
use Gugunso\LaravelNotificationTemplate\Entity\EmptyDto;
use Gugunso\LaravelNotificationTemplate\TemplatedNotification;
use Gugunso\LaravelNotificationTemplate\Test\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

/**
 * @coversDefaultClass \Gugunso\LaravelNotificationTemplate\TemplatedNotification
 * Gugunso\LaravelNotificationTemplate\Tests\Feature\TemplatedNotificationTest
 */
class TemplatedNotificationTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = TemplatedNotification::class;

    /**
     * @coversNothing
     */
    public function test_send1()
    {
        //初期化
        Notification::fake();
        $this->init();

        //送信処理
        $dummyNotifiable = new DummyNotifiable();
        $notification = new TemplatedNotification(1);
        $notification->assignToAll(new \stdClass());
        $dummyNotifiable->notify($notification);

        //assertion
        Notification::assertSentTo(
            $dummyNotifiable,
            TemplatedNotification::class,
            function ($notification, $channels) {
                $this->assertSame(['mail', 'database'], $channels);
                return true;
            }
        );
    }

    public function init()
    {
        //File（設定ファイルが存在していることにする）
        File::shouldReceive('exists')->andReturnTrue();
        File::makePartial();

        //Config（設定ファイル内容をテスト用に準備）
        Config::set('app.locale', 'ja');
        Config::set('mail.from.address', 'test-mail-driver@feature-test.example.com');
        Config::set('mail.from.name', 'テスト');

        Config::set('notification-template', $this->config());
        //テスト用のbladeディレクトリをviewの検索対象パスを追加
        $paths = Config::get('view.paths');
        $dirName = realpath(dirname(__FILE__) . '/views');
        Config::set('view.paths', array_merge($paths, [0 => $dirName]));
    }

    public function config()
    {
        return [
            'notification_settings' => [
                1 => [
                    'id' => 1,
                    'name' => 'test-case01',
                    'notification_templates' => [
                        [
                            'id' => 1,
                            'viewName' => 'mail-test',
                            'channel' => 'mail',
                            'locale' => 'ja',
                        ],
                        [
                            'id' => 2,
                            'viewName' => 'database-test',
                            'channel' => 'database',
                            'locale' => 'ja',
                        ],
                    ],
                ],
                2 => [
                    'id' => 2,
                    'name' => 'test-case02',
                    'notification_templates' => [
                        [
                            'id' => 3,
                            'viewName' => 'mail-test',
                            'channel' => 'mail',
                            'dtoClass' => EmptyDto::class,
                            'locale' => 'ja',
                        ],
                        [
                            'id' => 4,
                            'viewName' => 'mail-en.test',
                            'channel' => 'mail',
                            'dtoClass' => EmptyDto::class,
                            'locale' => 'en',
                        ],
                    ],
                ]
            ]
        ];
    }

    /**
     * @coversNothing
     */
    public function test_send2()
    {
        //初期化
        Notification::fake();
        $this->init();

        //送信処理
        $dummyNotifiable = new DummyNotifiable();
        $notification = new TemplatedNotification(2);
        $notification->assignToAll(new EmptyDto());
        $notification->locale('en');
        $dummyNotifiable->notify($notification);

        //assertion
        Notification::assertSentTo(
            $dummyNotifiable,
            TemplatedNotification::class
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }


}
