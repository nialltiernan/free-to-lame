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
    private $userReadRepository;

    /** @var \User\Repository\UserWriteRepositoryInterface */
    private $userWriteRepository;

    public function __construct(UserReadRepositoryInterface $userReadRepository, UserWriteRepositoryInterface $userWriteRepository)
    {
        $this->userReadRepository = $userReadRepository;
        $this->userWriteRepository = $userWriteRepository;
    }

    public function indexAction()
    {
        $users = $this->userReadRepository->getAll();

        $newUser = $this->userWriteRepository->create(['username' => 'fasfsda', 'email' =>'fasf', 'password' => 'fasd']);

        return new ViewModel(['users' => $users]);
    }

}
