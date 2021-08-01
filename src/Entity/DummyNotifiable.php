<?php


namespace Gugunso\LaravelNotificationTemplate\Entity;


use Illuminate\Notifications\Notifiable;

/**
 * Class DummyNotifiable for Feature Test
 * @package Gugunso\LaravelNotificationTemplate\Entity
 * @codeCoverageIgnore
 */
class DummyNotifiable
{
    use Notifiable;

    public $id = 1;
    public $email = '';

    public function getKey(){
        return $this->id;
    }
}