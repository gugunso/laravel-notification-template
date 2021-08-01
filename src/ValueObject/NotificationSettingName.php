<?php

namespace Gugunso\LaravelNotificationTemplate\ValueObject;

use Gugunso\LaravelNotificationTemplate\Exceptions\BadConfigurationException;
use InvalidArgumentException;

/**
 * Class NotificationSettingName
 * @package Gugunso\LaravelNotificationTemplate\ValueObject
 */
class NotificationSettingName extends StringValue
{
    /**
     * @param string $value
     */
    protected function setValue(string $value): void
    {
        if ($value === '') {
            throw new InvalidArgumentException('通知名が空文字列');
        }
        $this->value = $value;
    }
}