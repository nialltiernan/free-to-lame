<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\AuthController;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;
use User\Service\AuthenticationService;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userWriteRepository = $container->get(UserWriteRepositoryInterface::class);

        $registerForm = $container->get(RegisterForm::class);

        $loginForm = $container->get(LoginForm::class);

        $authenticationService = $container->get(AuthenticationService::class);

        return new AuthController($userWriteRepository, $registerForm, $loginForm, $authenticationService);
    }
}
