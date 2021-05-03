<?php

namespace Account\Controller;

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

    public function indexAction(): ViewModel
    {
        return new ViewModel(['userId' => (int) $this->params()->fromRoute('userId')]);
    }

    public function indexJsonAction(): JsonModel
    {
        $userId = (int) $this->params()->fromRoute('userId');

        try {
            $user = $this->readRepository->get($userId);
            $data = ['id' => $user->getId(), 'username' => $user->getUsername(), 'email' => $user->getEmail()];
        } catch (UserDoesNotExistException $exception) {
            $data = [];
        }

        return new JsonModel(['data' => $data]);
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isGet()) {
            return new ViewModel();
        }

        $userId = (int) $this->params()->fromRoute('userId');

        if ($this->getRequest()->getPost('delete') === 'Yes') {
            $this->logoutUser();
            $this->writeRepository->delete($userId);
            $this->flashAccountDeletedMessage();

            return $this->redirect()->toRoute('home');
        }

        return $this->redirect()->toRoute('account', ['userId' => $userId]);
    }

    public function logoutUser(): void
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);
        $identity->getAuthenticationService()->clearIdentity();
    }

    public function flashAccountDeletedMessage(): void
    {
        /** @var \Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger $flashMessenger */
        $flashMessenger = $this->plugin(FlashMessenger::class);
        $flashMessenger->addInfoMessage('Account deleted');
    }
}