<?php
declare(strict_types=1);

namespace User\Event;

use Laminas\EventManager\EventManager;
use Laminas\EventManager\EventManagerAwareInterface;
use Laminas\EventManager\EventManagerInterface;
use User\Model\User;

class UserCreatedEvent implements EventManagerAwareInterface
{
    /** @var EventManagerInterface */
    private $eventManager;

    /**
     * @inheritDoc
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers([__CLASS__, get_class($this)]);
        $this->eventManager = $eventManager;
    }

    public function getEventManager(): EventManagerInterface
    {
        if (! $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    public function fire(User $user)
    {
        $this->getEventManager()->trigger(__FUNCTION__, $this, $user);
    }
}
