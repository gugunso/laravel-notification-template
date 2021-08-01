<?php

namespace Gugunso\LaravelNotificationTemplate\Command;

use Gugunso\LaravelNotificationTemplate\Service\Command\TemplateListService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

/**
 * Class NotificationTemplateList
 * @package Gugunso\LaravelNotificationTemplate\Command
 */
class TemplateList extends Command
{
    /** @var string $signature */
    protected $signature = 'notification-template:list';
    /** @var string $description */
    protected $description = '通知テンプレートの一覧を出力する';
    /** @var TemplateListService $service */
    private $service;

    /**
     * @return void
     */
    public function handle()
    {
        try {
            $this->init();
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return 1;
        }


        $allSettings = $this->service->getDto();
        $this->table($allSettings->header(), $allSettings->toArray());
    }

    /**
     * @return void
     */
    private function init(): void
    {
        $this->service = App::make(TemplateListService::class);
    }
}
