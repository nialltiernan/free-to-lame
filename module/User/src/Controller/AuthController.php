<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\ViewModel;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;
use User\Service\AuthenticationService;

class AuthController extends AbstractActionController
{

    /** @var \User\Repository\UserWriteRepositoryInterface */
    private $writeRepository;

    /** @var \User\Form\RegisterForm */
    private $registerForm;

    /** @var \User\Form\LoginForm */
    private $loginForm;

    /** @var \Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger  */
    private $flashMessenger;

    public function __construct(
        UserWriteRepositoryInterface $writeRepository,
        RegisterForm $registerForm,
        LoginForm $loginForm
    ) {
        $this->writeRepository = $writeRepository;
        $this->registerForm = $registerForm;
        $this->loginForm = $loginForm;
        $this->flashMessenger = $this->plugin(FlashMessenger::class);
    }

    /**
     * @return \Laminas\Http\Response | \Laminas\View\Model\ViewModel
     */
    public function registerAction()
    {
        if ($this->getRequest()->isGet()) {
            return new ViewModel(['form' => $this->registerForm]);
        }

        $params = $this->getRequest()->getPost();

        $this->registerForm->setData($params);

        if (!$this->registerForm->isValid()) {
            return new ViewModel(['form' => $this->registerForm]);
        }

        $this->writeRepository->create($params->toArray());

        $this->flashMessenger->addSuccessMessage('Account created successfully!');

        return $this->redirect()->toRoute('home');
    }

    /**
     * @return \Laminas\Http\Response | \Laminas\View\Model\ViewModel
     */
    public function loginAction()
    {
        if ($this->getRequest()->isGet()) {
            return new ViewModel(['form' => $this->loginForm, 'message' => 'Login below']);
        }

        $params = $this->getRequest()->getPost();

        $this->loginForm->setData($params);

        if (!$this->loginForm->isValid()) {
            return new ViewModel(['form' => $this->loginForm, 'message' => 'Invalid input']);
        }

        $authenticationService = $this->authenticate($params['username'], $params['password']);

        if ($authenticationService->hasIdentity()) {
            $user = $authenticationService->getIdentity();

            $this->flashMessenger->addSuccessMessage('You have logged in, ' . $user->getUsername());

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(['form' => $this->loginForm, 'message' => 'Failed to log in']);
    }

    private function authenticate(string $username, string $password): AuthenticationServiceInterface
    {
        $authenticationService = $this->getAuthenticationService();

        $authenticationService->setCredentials($username, $password);
        $authenticationService->authenticate();

        return $authenticationService;
    }

    private function getAuthenticationService(): AuthenticationService
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        return $identity->getAuthenticationService();
    }

    public function logoutAction(): Response
    {
        $authenticationService = $this->getAuthenticationService();

        $authenticationService->clearIdentity();

        $this->flashMessenger->addInfoMessage('You have logged out');

        return $this->redirect()->toRoute('home');
    }
}
