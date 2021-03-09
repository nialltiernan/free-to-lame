<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Repository\UserRepositoryInterface;

class UserController extends AbstractActionController
{
    /**
     * @var \User\Repository\UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexAction()
    {
        $users = $this->userRepository->getAll();

        return new ViewModel(['users' => $users]);
    }

}
