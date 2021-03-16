<?php
declare(strict_types=1);

namespace User\Listener;

use Application\Service\Logger;
use Closure;
use Laminas\EventManager\Event;

class UserCreatedEventListener
{
    public static function logEvent(): Closure
    {
        return function (Event $event) {
            /** @var \User\Model\User $user */
            $user = $event->getParams();
            Logger::debug('A new user account was created by ' . $user->getUsername());
        };
    }
}
