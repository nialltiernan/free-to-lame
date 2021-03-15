<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
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

    public function __construct(
        UserWriteRepositoryInterface $writeRepository,
        RegisterForm $registerForm,
        LoginForm $loginForm
    ) {
        $this->writeRepository = $writeRepository;
        $this->registerForm = $registerForm;
        $this->loginForm = $loginForm;
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

        $this->flashSuccessMessage('Account created successfully!');

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

        $authenticator = $this->login($params['username'], $params['password']);

        if ($authenticator->hasIdentity()) {
            $user = $authenticator->getIdentity();

            $this->flashSuccessMessage('You have logged in, ' . $user->getUsername());

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(['form' => $this->loginForm, 'message' => 'Failed to log in']);
    }

    private function login(string $username, string $password): AuthenticationService
    {
        $authenticator = $this->getAuthenticationService();

        $authenticator->setCredentials($username, $password);
        $authenticator->authenticate();

        return $authenticator;
    }

    private function getAuthenticationService(): AuthenticationService
    {
        return $this->plugin('identity')->getAuthenticationService();
    }

    private function flashSuccessMessage(string $message)
    {
        $flash = $this->getFlashMessenger();
        $flash->addSuccessMessage($message);
    }

    private function getFlashMessenger(): FlashMessenger
    {
        return $this->plugin('flashMessenger');
    }

    public function logoutAction(): Response
    {
        $authenticator = $this->getAuthenticationService();

        $authenticator->clearIdentity();

        $flash = $this->getFlashMessenger();

        $flash->addInfoMessage('You have logged out');

        return $this->redirect()->toRoute('home');
    }
}
