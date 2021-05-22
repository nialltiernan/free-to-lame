<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Exception\CouldNotCreateUserException;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;

class AuthController extends AbstractActionController
{

    private UserWriteRepositoryInterface $writeRepository;
    private RegisterForm $registerForm;
    private LoginForm $loginForm;

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
     * @return \Laminas\Http\Response|\Laminas\View\Model\ViewModel
     */
    public function registerAction()
    {
        if ($this->getRequest()->isGet()) {
            return new ViewModel();
        }

        $data = json_decode($this->getRequest()->getContent(), true);

        $this->registerForm->setData($data);

        if (!$this->registerForm->isValid()) {
            return (new Response())
                ->setStatusCode(Response::STATUS_CODE_400)
                ->setReasonPhrase('Registration failed')
                ->setContent(json_encode($this->registerForm->getMessages()));
        }

        try {
            $user = $this->writeRepository->create($data);
        } catch (CouldNotCreateUserException $exception) {
            return (new Response())
                ->setStatusCode(Response::STATUS_CODE_500)
                ->setReasonPhrase($exception->getMessage());
        }

        $this->authenticate($data['username'], $data['password']);
        return (new JsonModel(['data' => $user->toArray()]))->setTemplate('json/index.phtml');
    }

    /**
     * @return \Laminas\Http\Response | \Laminas\View\Model\ViewModel
     */
    public function loginAction()
    {
        if ($this->getRequest()->isGet()) {
            return new ViewModel();
        }

        $params = json_decode($this->getRequest()->getContent(), true);

        $authenticationService = $this->authenticate($params['username'], $params['password']);

        if ($authenticationService->hasIdentity()) {
            /** @var \User\Model\User $user */
            $user = $authenticationService->getIdentity();
            return (new JsonModel(['data' => $user->toArray()]))->setTemplate('json/index.phtml');
        }

        return (new Response)->setStatusCode(Response::STATUS_CODE_401);
    }

    private function authenticate(string $username, string $password): AuthenticationServiceInterface
    {
        $authenticationService = $this->getAuthenticationService();

        $authenticationService->setCredentials($username, $password);
        $authenticationService->authenticate();

        return $authenticationService;
    }

    private function getAuthenticationService(): AuthenticationServiceInterface
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);
        return $identity->getAuthenticationService();
    }

    public function logoutAction(): JsonModel
    {
        $this->logoutUser();
        return (new JsonModel(['data' => ['status' => 'success']]))->setTemplate('json/index.phtml');
    }

    private function logoutUser(): void
    {
        $authenticationService = $this->getAuthenticationService();
        $authenticationService->clearIdentity();
    }
}
