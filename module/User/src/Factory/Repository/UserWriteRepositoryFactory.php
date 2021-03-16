<?php
declare(strict_types=1);

namespace User\Factory\Repository;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\EventManager\EventManager;
use Laminas\EventManager\SharedEventManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Event\UserCreatedEvent;
use User\Listener\UserCreatedEventListener;
use User\Repository\UserWriteRepository;

class UserWriteRepositoryFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $db = $container->get(DatabaseAdapter::class);

        $createdEvent = $this->getUserCreatedEvent();

        return new UserWriteRepository($db, $createdEvent);
    }

    private function getUserCreatedEvent(): UserCreatedEvent
    {
        $sharedEvents = new SharedEventManager();

        $sharedEvents->attach(UserCreatedEvent::class, 'fire', call_user_func([UserCreatedEventListener::class, 'logEvent']));

        $createdEvent = new UserCreatedEvent();
        $createdEvent->setEventManager(new EventManager($sharedEvents));

        return $createdEvent;
    }
}
