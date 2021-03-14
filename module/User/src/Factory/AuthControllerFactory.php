<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\AuthController;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $writeRepository = $container->get(UserWriteRepositoryInterface::class);

        $registerForm = $container->get(RegisterForm::class);

        $loginForm = $container->get(LoginForm::class);

        return new AuthController($writeRepository, $registerForm, $loginForm);
    }
}
