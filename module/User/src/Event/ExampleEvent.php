<?php
declare(strict_types=1);

namespace User\Event;

use Laminas\EventManager\EventManager;
use Laminas\EventManager\EventManagerAwareInterface;
use Laminas\EventManager\EventManagerInterface;

class ExampleEvent implements EventManagerAwareInterface
{
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

    public function doIt()
    {
        print('Just fucking DO IT <br>');
        $this->getEventManager()->trigger(__FUNCTION__, $this);
    }
}
