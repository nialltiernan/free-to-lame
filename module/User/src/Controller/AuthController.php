<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
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

        $authenticator = $this->getAuthenticationService();

        $authenticator->setCredentials($params['username'], $params['password']);
        $authenticator->authenticate();

        if ($authenticator->hasIdentity()) {
            $user = $authenticator->getIdentity();
            $message = $user->getUsername() . ' logged in successfully!';
        } else {
            $message = 'Failed to log in';
        }

        return new ViewModel(['form' => $this->loginForm, 'message' => $message]);
    }

    private function getAuthenticationService(): AuthenticationService
    {
        return $this->plugin('identity')->getAuthenticationService();
    }

    public function logoutAction(): Response
    {
        $authenticator = $this->getAuthenticationService();

        $authenticator->clearIdentity();

        return $this->redirect()->toRoute('home');
    }
}
