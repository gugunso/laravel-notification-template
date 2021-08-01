<?php

namespace Gugunso\LaravelNotificationTemplate\Drivers\Mail\Contracts;

interface HasSubject
{
    public function subject(): string;
}