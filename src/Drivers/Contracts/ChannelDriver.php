<?php

namespace Gugunso\LaravelNotificationTemplate\Drivers\Contracts;

use Gugunso\LaravelNotificationTemplate\Entity\Contracts\NotificationTemplate;

interface ChannelDriver
{
    /**
     * @return NotificationTemplate
     */
    public function getConfig(): NotificationTemplate;

    /**
     * @return mixed
     */
    public function getDtoObject();
}