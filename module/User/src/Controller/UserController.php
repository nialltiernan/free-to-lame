<?php
declare(strict_types=1);

namespace User\Controller;

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

        $newUser = $this->writeRepository->create(['username' => 'fasfsda', 'email' =>'fasf', 'password' => 'fasd']);

        return new ViewModel(['users' => $users]);
    }

}
