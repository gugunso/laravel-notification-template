<?php

namespace Gugunso\LaravelNotificationTemplate\Drivers\Database\Contracts;

use Gugunso\LaravelNotificationTemplate\Drivers\Contracts\ChannelDriver;

interface DatabaseChannelDriver extends ChannelDriver
{
    public function build(): array;
}