<?php

namespace Account\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Exception\UserDoesNotExistException;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;

class AccountController extends AbstractActionController
{
    private UserReadRepositoryInterface $readRepository;
    private UserWriteRepositoryInterface $writeRepository;

    public function __construct(
        UserReadRepositoryInterface $readRepository,
        UserWriteRepositoryInterface $writeRepository
    ) {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
    }

    /**
     * @return \Laminas\Http\Response|\Laminas\View\Model\ViewModel
     */
    public function indexAction()
    {
        if (!$this->hasUserAccess()) {
            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(['userId' => (int) $this->params()->fromRoute('userId')]);
    }

    public function indexJsonAction(): JsonModel
    {
        if (!$this->hasUserAccess()) {
            return new JsonModel();
        }

        $userId = (int) $this->params()->fromRoute('userId');

        try {
            $user = $this->readRepository->get($userId);
            $data = ['id' => $user->getId(), 'username' => $user->getUsername(), 'email' => $user->getEmail()];
        } catch (UserDoesNotExistException $exception) {
            $data = [];
        }

        return new JsonModel(['data' => $data]);
    }

    public function deleteAction(): Response
    {
        if (!$this->hasUserAccess()) {
            return $this->redirect()->toRoute('home');
        }

        $this->logoutUser();
        $this->writeRepository->delete((int) $this->params()->fromRoute('userId'));
        $this->flashAccountDeletedMessage();

        return $this->redirect()->toRoute('home');
    }

    private function logoutUser(): void
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);
        $identity->getAuthenticationService()->clearIdentity();
    }

    private function flashAccountDeletedMessage(): void
    {
        /** @var \Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger $flashMessenger */
        $flashMessenger = $this->plugin(FlashMessenger::class);
        $flashMessenger->addInfoMessage('Account deleted');
    }

    private function hasUserAccess(): bool
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        if (!$identity->getAuthenticationService()->hasIdentity()) {
            return false;
        }

        /** @var \User\Model\User $user */
        $user = $identity->getAuthenticationService()->getIdentity();

        return $user->getId() === (int) $this->params()->fromRoute('userId');
    }
}