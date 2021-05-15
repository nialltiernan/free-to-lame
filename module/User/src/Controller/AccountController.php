<?php

namespace User\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Controller\Plugin\UserColorPlugin;
use User\Exception\UserDoesNotExistException;
use User\Factory\Form\UserUpdateFormFactory;
use User\Form\UserUpdateForm;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;
use User\Service\AuthenticationService;

class AccountController extends AbstractActionController
{
    private UserReadRepositoryInterface $readRepository;
    private UserWriteRepositoryInterface $writeRepository;
    private ServiceManager $serviceManager;

    public function __construct(
        UserReadRepositoryInterface $readRepository,
        UserWriteRepositoryInterface $writeRepository,
        ServiceManager $serviceManager
    ) {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
        $this->serviceManager = $serviceManager;
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
            'color' => $this->getColor()
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

        return (new JsonModel(['data' => $data]))->setTemplate('json/index.phtml');
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

    /**
     * @return \Laminas\Http\Response
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function updateUserAction(): Response
    {
        if (!$this->hasUserAccess()) {
            return (new Response)->setStatusCode(Response::STATUS_CODE_401);
        }

        if (!$this->getRequest()->isPost()) {
            return (new Response)->setStatusCode(Response::STATUS_CODE_405);
        }

        $authenticationService = $this->getAuthenticationService();

        /** @var \User\Model\User $user */
        $user = $authenticationService->getIdentity();

        $userUpdateForm = $this->getUserUpdateForm($user->getId());

        $data = json_decode($this->getRequest()->getContent(), true);

        $userUpdateForm->setData($data);

        if (!$userUpdateForm->isValid()) {
            return (new Response())
                ->setStatusCode(Response::STATUS_CODE_400)
                ->setReasonPhrase('Validation failed')
                ->setContent(json_encode($userUpdateForm->getMessages()));
        }

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

    private function getAuthenticationService(): AuthenticationService
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        return $identity->getAuthenticationService();
    }

    /**
     * @param int $userId
     * @return \User\Form\UserUpdateForm
     * @throws \Interop\Container\Exception\ContainerException
     */
    private function getUserUpdateForm(int $userId): UserUpdateForm
    {
        $factory = new UserUpdateFormFactory();
        return $factory($this->serviceManager, UserUpdateForm::class, ['userId' => $userId]);
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

    private function getColor(): string
    {
        /** @var \User\Controller\Plugin\UserColorPlugin $colorPlugin */
        $colorPlugin = $this->plugin(UserColorPlugin::NAME);
        return $colorPlugin->getColor($this->plugin(Identity::class));
    }
}