<?php

namespace Gugunso\LaravelNotificationTemplate\Tests\Feature\Customize\Mail;

use Gugunso\LaravelNotificationTemplate\Drivers\Mail\EmptyMailDriver;
use Gugunso\LaravelNotificationTemplate\Drivers\Mail\Mail;
use Gugunso\LaravelNotificationTemplate\Entity\DummyNotifiable;
use Gugunso\LaravelNotificationTemplate\Entity\EmptyDto;
use Gugunso\LaravelNotificationTemplate\Exceptions\DtoMismatchException;
use Gugunso\LaravelNotificationTemplate\Repository\Contracts\NotificationSettingRepository;
use Gugunso\LaravelNotificationTemplate\TemplatedNotification;
use Gugunso\LaravelNotificationTemplate\Test\TestCase;
use Illuminate\Contracts\View\Factory;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\ViewFinderInterface;

/**
 * @coversNothing
 * メールドライバのカスタマイズを想定したテスト
 */
class CustomizeMailTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = Mail::class;

    public function test_mailDriverDto()
    {
        $this->init();
        $notification = new TemplatedNotification(1);
        $notification->assignToAll(new EmptyDto());
    }

    /**
     * パッケージ全体が実際に動作する状態となるよう設定を偽装する
     */
    public function init()
    {
        //File（設定ファイルが存在していることにする）
        File::shouldReceive('exists')->andReturnTrue();
        File::makePartial();
        //Config（設定ファイル内容をテスト用に準備）
        Config::set('app.locale', 'ja');
        Config::set('mail.from.address', 'test-mail-driver@feature-test.example.com');
        Config::set('mail.from.name', 'テスト');

        $paths = Config::get('view.paths');
        $dirName=realpath(dirname(__FILE__).'/../../views');
        Config::set('view.paths', array_merge($paths,[0=>$dirName]));

        Config::set('notification-template', $this->config());
    }

    public function config()
    {
        return [
            'notification_settings' => [
                1 => [
                    'id' => 1,
                    'name' => 'mail-driver-test1',
                    'notification_templates' => [
                        [
                            'id' => 1,
                            'viewName' => 'mail-test',
                            'channel' => 'mail',
                            'dtoClass' => EmptyDto::class,
                            'locale' => 'ja',
                            'driver' => EmptyMailDriver::class,
                        ],
                    ],
                ],
                2 => [
                    'id' => 2,
                    'name' => 'mail-driver-test2',
                    'notification_templates' => [
                        [
                            'id' => 2,
                            'viewName' => 'database-test',
                            'channel' => 'mail',
                            'dtoClass' => EmptyDto::class,
                            'driver' => '',
                            'locale' => 'ja',

                        ],
                    ],
                ]
            ]
        ];
    }

    public function test_mailDriverDtoException()
    {
        $this->init();
        $notification = new TemplatedNotification(1);
        $this->expectException(DtoMismatchException::class);
        $notification->assignToAll(new \stdClass());
    }
}
