<?php


namespace Gugunso\LaravelNotificationTemplate\Entity\NotificationTemplate;

use Gugunso\LaravelNotificationTemplate\Drivers\Contracts\ChannelDriver;
use Gugunso\LaravelNotificationTemplate\Entity\Contracts\NotificationTemplate;
use Gugunso\LaravelNotificationTemplate\ValueObject\DriverName;
use Gugunso\LaravelNotificationTemplate\ValueObject\DtoClassName;
use Gugunso\LaravelNotificationTemplate\ValueObject\NotificationChannel;
use Gugunso\LaravelNotificationTemplate\ValueObject\ViewName;
use Gugunso\ReadOnlyObject\ReadOnlyArray;
use Illuminate\Support\Facades\App;

/**
 * Class NotificationTemplate
 * @package Gugunso\LaravelNotificationTemplate\Entity
 */
class DefaultSetting extends ReadOnlyArray implements NotificationTemplate
{
    protected $id;
    /** @var ViewName $viewName テンプレートファイル名 */
    protected $viewName;
    /** @var NotificationChannel $channel このテンプレートの送信に利用されるチャンネル名 */
    protected $channel;
    /** @var DtoClassName $dtoClass テンプレートにアサインされるオブジェクトのクラス名 */
    protected $dtoClass;
    /** @var string $locale 言語 */
    protected $locale;
    /** @var DriverName $driver */
    protected $driver;

    /**
     * Base constructor.
     * @param $id
     * @param string $viewName
     * @param string $channel
     * @param string $dtoClass
     * @param string $locale
     * @param string $driver
     */
    public function __construct(
        $id,
        string $viewName,
        string $channel,
        string $locale,
        string $dtoClass = '',
        string $driver = ''
    ) {
        $this->id = $id;
        $this->viewName = App::make(ViewName::class, ['value' => $viewName]);
        $this->channel = App::make(NotificationChannel::class, ['value' => $channel]);
        $this->dtoClass = App::make(DtoClassName::class, ['value' => $dtoClass]);
        $this->driver = App::make(DriverName::class, ['value' => $driver, 'channel' => $this->channel]);
        $this->locale = $locale;
    }

    /**
     * @param $dtoObject
     * @param $notifiable
     * @return ChannelDriver
     */
    public function createDriverObject($dtoObject, $notifiable): ChannelDriver
    {
        $driverName = $this->getDriver();
        return App::make(
            (string)$driverName,
            [
                'config' => $this,
                'dtoObject' => $dtoObject,
                'notifiable' => $notifiable
            ]
        );
    }

    /**
     * @return DriverName
     */
    public function getDriver(): DriverName
    {
        return $this->driver;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return NotificationChannel
     */
    public function getChannel(): NotificationChannel
    {
        return $this->channel;
    }

    /**
     * @return ViewName
     */
    public function getViewName(): ViewName
    {
        return $this->viewName;
    }

    /**
     * @return DtoClassName
     */
    public function getDtoClass(): DtoClassName
    {
        return $this->dtoClass;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

}