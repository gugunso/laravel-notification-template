<?php


namespace Gugunso\LaravelNotificationTemplate\Exceptions;

use Exception;
use Gugunso\LaravelNotificationTemplate\ValueObject\NotificationChannel;
use Throwable;

class TemplateNotFoundException extends Exception
{
    public function __construct(
        NotificationChannel $channel,
        string $locale,
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        $message='NotificationTemplate not found. [channel :'.$channel.'] [locale:'.$locale.'] '.$message;
        parent::__construct($message, $code, $previous);
    }


}