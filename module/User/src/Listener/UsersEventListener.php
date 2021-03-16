<?php
declare(strict_types=1);

namespace User\Listener;

use Closure;
use Laminas\EventManager\Event;
use Laminas\Log\Logger;
use Laminas\Log\Writer\Stream;

class UsersEventListener
{
    public static function logEvent(): Closure
    {
        return function (Event $event) {
            $logger = new Logger();
            $file = new Stream('/home/niall/Projects/free-to-lame/data/debug.log');
            $logger->addWriter($file);
            $logger->log(Logger::DEBUG, 'A new user account was created :D');
        };
    }
}
