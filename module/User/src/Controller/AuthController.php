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

    /** @var \User\Service\AuthenticationService */
    private $authenticationService;

    public function __construct(
        UserWriteRepositoryInterface $writeRepository,
        RegisterForm $registerForm,
        LoginForm $loginForm
    ) {
        $this->writeRepository = $writeRepository;
        $this->registerForm = $registerForm;
        $this->loginForm = $loginForm;
        $this->flashMessenger = $this->plugin(FlashMessenger::class);
        $this->authenticationService = $this->plugin('identity')->getAuthenticationService();
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

        $this->authenticate($params['username'], $params['password']);

        if ($this->authenticationService->hasIdentity()) {
            $user = $this->authenticationService->getIdentity();

            $this->flashMessenger->addSuccessMessage('You have logged in, ' . $user->getUsername());

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(['form' => $this->loginForm, 'message' => 'Failed to log in']);
    }

    private function authenticate(string $username, string $password)
    {
        $this->authenticationService->setCredentials($username, $password);
        $this->authenticationService->authenticate();
    }

    public function logoutAction(): Response
    {
        /** @var \User\Service\AuthenticationService $authenticator */
        $authenticator = $this->plugin('identity')->getAuthenticationService();

        $authenticator->clearIdentity();

        $this->flashMessenger->addInfoMessage('You have logged out');

        return $this->redirect()->toRoute('home');
    }
}
