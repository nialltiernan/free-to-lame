<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Repository\UserReadRepositoryInterface;

class UserController extends AbstractActionController
{
    /**
     * @var \User\Repository\UserReadRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserReadRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexAction()
    {
        $users = $this->userRepository->getAll();

        return new ViewModel(['users' => $users]);
    }

}
