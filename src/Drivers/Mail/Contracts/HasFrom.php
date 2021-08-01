<?php

namespace Gugunso\LaravelNotificationTemplate\Drivers\Mail\Contracts;

use Gugunso\LaravelNotificationTemplate\ValueObject\MailFrom;

interface HasFrom
{
    public function from(): MailFrom;
}