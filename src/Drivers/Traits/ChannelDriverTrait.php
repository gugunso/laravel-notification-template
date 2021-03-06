<?php

namespace Gugunso\LaravelNotificationTemplate\Drivers\Traits;

use Gugunso\LaravelNotificationTemplate\Entity\Contracts\NotificationTemplate;

/**
 * Trait ChannelDriverTrait
 * @package Gugunso\LaravelNotificationTemplate\Drivers\Traits
 */
trait ChannelDriverTrait
{
    /** @var NotificationTemplate $config */
    private $config;

    /** @var mixed $dtoObject */
    private $dtoObject;

    /** @var mixed $notifiable */
    private $notifiable;

    /**
     * @return NotificationTemplate
     */
    public function getConfig(): NotificationTemplate
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function getDtoObject()
    {
        return $this->dtoObject;
    }

    /**
     * @return mixed
     */
    public function getNotifiable()
    {
        return $this->notifiable;
    }
}