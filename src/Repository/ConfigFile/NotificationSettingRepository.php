<?php

namespace Gugunso\LaravelNotificationTemplate\Repository\ConfigFile;

use Gugunso\LaravelNotificationTemplate\Common\LaravelCommonConfig;
use Gugunso\LaravelNotificationTemplate\Exceptions\BadConfigurationException;
use Gugunso\LaravelNotificationTemplate\Exceptions\ConfigFileNotFoundException;
use Gugunso\LaravelNotificationTemplate\Repository\Contracts\NotificationSettingRepository as RepoInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

/**
 * Class NotificationSettingRepository
 * @package Gugunso\LaravelNotificationTemplate\Repository\ConfigFile
 */
class NotificationSettingRepository implements RepoInterface
{
    /**
     * NotificationSettingRepository constructor.
     */
    public function __construct()
    {
        /** @var LaravelCommonConfig $laravelConfig */
        $laravelConfig = App::make(LaravelCommonConfig::class);

        //設定ファイルからのロードを試行する
        if (!File::exists($laravelConfig->getConfigPath('notification-template.php'))) {
            throw new ConfigFileNotFoundException('設定ファイルが見つかりません');
        }

        if (!Config::get('notification-template.notification_settings')) {
            throw new BadConfigurationException('必須項目:notification_settings');
        }
    }


    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        return Config::get('notification-template.notification_settings.' . $id);
    }

    /**
     * @return iterable<array>
     */
    public function all(): iterable
    {
        foreach (Config::get('notification-template.notification_settings') as $arrSetting) {
            yield $arrSetting;
        }
    }
}