<?php

namespace Gugunso\LaravelNotificationTemplate\Service\Command;

use Gugunso\LaravelNotificationTemplate\DataTransferObject\AllSetting;
use Gugunso\LaravelNotificationTemplate\Service\NotificationSettingService;
use Illuminate\Support\Facades\App;

class TemplateListService
{
    /** @var NotificationSettingService $notificationSetting */
    private $notificationSettingService;
    /** @var AllSetting $dto */
    private $dto;

    /**
     * ConfigureCheckService constructor.
     */
    public function __construct()
    {
        $this->notificationSettingService = App::make(NotificationSettingService::class);
        $this->dto = App::make(AllSetting::class, ['settings' => $this->notificationSettingService->all()]);
    }

    /**
     * @return AllSetting
     */
    public function getDto(): AllSetting
    {
        return $this->dto;
    }
}