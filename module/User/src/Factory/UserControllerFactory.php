<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\UserController;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;

class UserControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userReadRepository = $container->get(UserReadRepositoryInterface::class);

        $userWriteRepository = $container->get(UserWriteRepositoryInterface::class);

        return new UserController($userReadRepository, $userWriteRepository);
    }
}
