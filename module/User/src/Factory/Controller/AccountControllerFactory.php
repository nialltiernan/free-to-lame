<?php

namespace User\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceManager;
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
        return new AccountController(
            $container->get(UserReadRepositoryInterface::class),
            $container->get(UserWriteRepositoryInterface::class),
            $container->get(ServiceManager::class)
        );
    }
}