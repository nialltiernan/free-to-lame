<?php
declare(strict_types=1);

namespace User\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\UserController;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;

class UserControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): UserController
    {
        $readRepository = $container->get(UserReadRepositoryInterface::class);

        $writeRepository = $container->get(UserWriteRepositoryInterface::class);

        return new UserController($readRepository, $writeRepository);
    }
}
