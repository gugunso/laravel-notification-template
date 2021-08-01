<?php

namespace Gugunso\LaravelNotificationTemplate\ValueObject;

use Gugunso\KeyValueList\Contracts\BehaveAsKeyValueList;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Contracts\KeyValueListable;
use Gugunso\KeyValueList\Definer\ArrayDefiner;
use Gugunso\KeyValueList\LaravelCacheClassification;
use Gugunso\KeyValueList\Traits\BehaveAsKeyValueListTrait;
use Gugunso\LaravelNotificationTemplate\Drivers\Database\Contracts\DatabaseChannelDriver;
use Gugunso\LaravelNotificationTemplate\Drivers\Database\Database;
use Gugunso\LaravelNotificationTemplate\Drivers\Mail\Contracts\MailChannelDriver;
use Gugunso\LaravelNotificationTemplate\Drivers\Mail\Mail;
use Gugunso\LaravelNotificationTemplate\Entity\NotificationTemplate\DefaultSetting;
use Gugunso\LaravelNotificationTemplate\Entity\NotificationTemplate\MailSetting;


/**
 * Class SupportedChannelList
 * @package Gugunso\LaravelNotificationTemplate\Entity
 */
class SupportedChannelList extends LaravelCacheClassification implements BehaveAsKeyValueList
{
    use BehaveAsKeyValueListTrait;

    public function getDefiner(): Definer
    {
        return new ArrayDefiner(
            [
                [
                    'name' => 'mail',
                    'defaultDriver' => Mail::class,
                    'driverInterface' => MailChannelDriver::class,
                    'configClass' => MailSetting::class
                ],
                [
                    'name' => 'database',
                    'defaultDriver' => Database::class,
                    'driverInterface' => DatabaseChannelDriver::class,
                    'configClass' => DefaultSetting::class
                ],
            ]
        );
    }

    /**
     * @return KeyValueListable
     */
    public function representativeList(): KeyValueListable
    {
        return $this->nameList();
    }

    /**
     * @return KeyValueListable
     */
    public function nameList(): KeyValueListable
    {
        return $this->listOf('name');
    }

    /**
     * @param $identity
     * @return mixed
     */
    public function defaultDriverOf($identity)
    {
        return $this->valueOf('defaultDriver', $identity);
    }

    /**
     * @param $identity
     * @return mixed
     */
    public function driverInterfaceOf($identity)
    {
        return $this->valueOf('driverInterface', $identity);
    }

    /**
     * @param $identity
     * @return mixed
     */
    public function configClassOf($identity)
    {
        return $this->valueOf('configClass', $identity);
    }

    protected function getIdentityIndex()
    {
        return 'name';
    }

}