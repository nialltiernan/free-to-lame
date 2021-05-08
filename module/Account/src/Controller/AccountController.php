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

        return new ViewModel([
            'userId' => (int) $this->params()->fromRoute('userId'),
            'color' => $this->getLoadingColor()
        ]);
    }

    public function indexJsonAction(): JsonModel
    {
        if (!$this->hasUserAccess()) {
            return new JsonModel();
        }

        $userId = (int) $this->params()->fromRoute('userId');

        try {
            $user = $this->readRepository->get($userId);
            $data = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'color' => $user->getColor(),
            ];
        } catch (UserDoesNotExistException $exception) {
            $data = [];
        }

        return new JsonModel(['data' => $data]);
    }

    public function deleteUserAction(): Response
    {
        if (!$this->hasUserAccess()) {
            return $this->redirect()->toRoute('home');
        }

        $this->logoutUser();
        $this->writeRepository->delete((int) $this->params()->fromRoute('userId'));
        $this->flashAccountDeletedMessage();

        return $this->redirect()->toRoute('home');
    }

    public function updateUserAction(): Response
    {
        if (!$this->hasUserAccess()) {
            return (new Response)->setStatusCode(Response::STATUS_CODE_401);
        }

        if (!$this->getRequest()->isPost()) {
            return (new Response)->setStatusCode(Response::STATUS_CODE_405);
        }

        $data = json_decode($this->getRequest()->getContent(), true);

        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);
        /** @var \User\Service\AuthenticationService $authenticationService */
        $authenticationService = $identity->getAuthenticationService();

        /** @var \User\Model\User $user */
        $user = $authenticationService->getIdentity();

        try {
            $user = $this->writeRepository->update($user, $data);
            $authenticationService->updateUser($user);
        } catch (UserDoesNotExistException $e) {
            return (new Response)
                ->setStatusCode(Response::STATUS_CODE_500)
                ->setReasonPhrase($e->getMessage());
        }

        return (new Response)->setStatusCode(Response::STATUS_CODE_201);
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

    private function getLoadingColor(): string
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        if ($identity->getAuthenticationService()->hasIdentity()){
            /** @var \User\Model\User $user */
            $user = $identity->getAuthenticationService()->getIdentity();
            return $user->getColor();
        }

        return 'blue';
    }
}