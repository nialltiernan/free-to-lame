<?php

namespace User\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\AccountController;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepositoryInterface;

class AccountControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AccountController
    {
        $readRepository = $container->get(UserReadRepositoryInterface::class);

        $writeRepository = $container->get(UserWriteRepositoryInterface::class);

        return new AccountController($readRepository, $writeRepository);
    }
}