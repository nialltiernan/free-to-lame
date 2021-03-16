<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Log\Logger;
use Laminas\Log\Writer\ChromePhp;
use Laminas\Log\Writer\Stream;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
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

}
