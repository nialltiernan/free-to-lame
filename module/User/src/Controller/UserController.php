<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\EventManager\EventManager;
use Laminas\EventManager\SharedEventManager;
use Laminas\Log\Logger;
use Laminas\Log\Writer\ChromePhp;
use Laminas\Log\Writer\Stream;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Event\ExampleEvent;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;

class UserController extends AbstractActionController
{
    /** @var \User\Repository\UserReadRepositoryInterface */
    private $readRepository;

    /** @var \User\Repository\UserWriteRepositoryInterface */
    private $writeRepository;

    public function __construct(UserReadRepositoryInterface $readRepository, UserWriteRepositoryInterface $writeRepository)
    {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
    }

    public function indexAction()
    {
        $users = $this->readRepository->getAll();

        $this->debugLog();

        $this->sharedEvents();

        return new ViewModel(['users' => $users]);
    }



    private function debugLog(): void
    {
        $logger = new Logger();

        $chrome = new ChromePhp();
        $file = new Stream('/home/niall/Projects/free-to-lame/data/debug.log');

        $logger->addWriter($chrome);
        $logger->addWriter($file);

        $logger->log(Logger::INFO, 'Informational message');
    }

    private function sharedEvents(): void
    {
        $sharedEvents = new SharedEventManager();

        $sharedEvents->attach(ExampleEvent::class, 'doIt', call_user_func([self::class, 'listener1']));
        $sharedEvents->attach(ExampleEvent::class, 'doIt', call_user_func([self::class, 'listener2']));

        $example = new ExampleEvent();
        $example->setEventManager(new EventManager($sharedEvents));
        $example->doIt();
    }

    public static function listener1(): \Closure
    {
        return function ($event) {
            print ('Shared event 1 for ' . get_class($event->getTarget()) . '::' . $event->getName() . '()<br>');
        };
    }

    public static function listener2(): \Closure
    {
        return function ($event) {
            print ('Shared event 2 for ' . get_class($event->getTarget()) . '::' . $event->getName() . '()<br>');
        };
    }

}
