<?php

namespace Gugunso\LaravelNotificationTemplate\Repository\Contracts;

use Gugunso\LaravelNotificationTemplate\Entity\NotificationSetting;

/**
 * Interface NotificationSettingRepository
 * @package Gugunso\LaravelNotificationTemplate\Repository
 */
interface NotificationSettingRepository
{
    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * @return iterable<NotificationSetting>
     */
    public function all(): iterable;
}