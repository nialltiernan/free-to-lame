<?php
declare(strict_types=1);

namespace User\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\AuthController;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AuthController
    {
        return new AuthController(
            $container->get(UserWriteRepositoryInterface::class),
            $container->get(RegisterForm::class),
            $container->get(LoginForm::class),
        );
    }
}
