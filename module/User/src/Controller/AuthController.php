<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Exception\CouldNotAuthenticateUserException;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;
use User\Service\AuthenticationService;

class AuthController extends AbstractActionController
{

    /** @var \User\Repository\UserWriteRepositoryInterface */
    private $userWriteRepository;

    /** @var \User\Form\RegisterForm */
    private $registerForm;

    /** @var \User\Form\LoginForm */
    private $loginForm;

    /** @var \User\Service\AuthenticationService */
    private $authenticationService;

    public function __construct(
        UserWriteRepositoryInterface $userWriteRepository,
        RegisterForm $registerForm,
        LoginForm $loginForm,
        AuthenticationService $authenticationService
    ) {
        $this->userWriteRepository = $userWriteRepository;
        $this->registerForm = $registerForm;
        $this->loginForm = $loginForm;
        $this->authenticationService = $authenticationService;
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

        $data = $params->toArray();
        unset($data['submit']);

        $this->userWriteRepository->create($data);

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

        try {
            $user = $this->authenticationService->execute($params['username'], $params['password']);
        } catch (CouldNotAuthenticateUserException $e) {
            return new ViewModel(['form' => $this->loginForm, 'message' => 'Failed to log in']);
        }

        return new ViewModel([
            'form' => $this->loginForm,
            'message' => $user->getUsername() . ' logged in successfully!'
        ]);
    }
}
