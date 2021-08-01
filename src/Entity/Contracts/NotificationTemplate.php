<?php

namespace Gugunso\LaravelNotificationTemplate\Entity\Contracts;

use ArrayAccess;
use Gugunso\LaravelNotificationTemplate\Drivers\Contracts\ChannelDriver;
use Gugunso\LaravelNotificationTemplate\ValueObject\DriverName;
use Gugunso\LaravelNotificationTemplate\ValueObject\DtoClassName;
use Gugunso\LaravelNotificationTemplate\ValueObject\NotificationChannel;
use Gugunso\LaravelNotificationTemplate\ValueObject\ViewName;

interface NotificationTemplate extends ArrayAccess
{
    public function getId(): int;

    public function getChannel(): NotificationChannel;

    public function getViewName(): ViewName;

    public function getDtoClass(): DtoClassName;

    public function getLocale(): string;

    public function toArray(): array;

    public function getDriver(): DriverName;

    public function createDriverObject($dtoObject, $notifiable): ChannelDriver;
}