<?php

namespace Gugunso\LaravelNotificationTemplate\ValueObject;

use Gugunso\LaravelNotificationTemplate\Entity\Contracts\NotificationTemplate;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

/**
 * Class NotificationChannel
 * serializeされることを考慮し、$channelList はあえてプロパティとして持たせていない。
 * @package Gugunso\LaravelNotificationTemplate\ValueObject
 */
class NotificationChannel extends StringValue
{
    /**
     * @param array $parameter
     * @return mixed
     */
    public function notificationTemplateObject(array $parameter): NotificationTemplate
    {
        /** @var SupportedChannelList $channelList */
        $channelList = App::make(SupportedChannelList::class);
        $className = $channelList->configClassOf($this->getValue());
        return App::make($className, $parameter);
    }

    /**
     * チャンネルのデフォルトドライバ名を返す
     * @return string
     */
    public function defaultDriverClassName(): string
    {
        /** @var SupportedChannelList $channelList */
        $channelList = App::make(SupportedChannelList::class);
        return $channelList->defaultDriverOf($this->getValue());
    }

    /**
     * チャンネルドライバが実装するべきインターフェース名を返す
     * @return string
     */
    public function driverInterfaceName(): string
    {
        /** @var SupportedChannelList $channelList */
        $channelList = App::make(SupportedChannelList::class);
        return $channelList->driverInterfaceOf($this->getValue());
    }

    /**
     * @param string $value
     */
    protected function setValue(string $value): void
    {
        /** @var SupportedChannelList $channelList */
        $channelList = App::make(SupportedChannelList::class);
        if (!$channelList->contains($value)) {
            throw new InvalidArgumentException('チャンネル名:' . $value . 'は未対応');
        }
        $this->value = $value;
    }

}