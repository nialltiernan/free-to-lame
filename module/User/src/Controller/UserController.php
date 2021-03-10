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
    private $userReadRepository;

    public function __construct(UserReadRepositoryInterface $userRepository)
    {
        $this->userReadRepository = $userRepository;
    }

    public function indexAction()
    {
        $users = $this->userReadRepository->getAll();

        return new ViewModel(['users' => $users]);
    }

}
