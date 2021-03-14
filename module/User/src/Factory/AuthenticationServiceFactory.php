<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\Container as Session;
use User\Repository\UserReadRepositoryInterface;
use User\Service\AuthenticationService;

class AuthenticationServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(AdapterInterface::class);

        $userReadRepository = $container->get(UserReadRepositoryInterface::class);

        $session = $container->get(Session::class);

        return new AuthenticationService($adapter, $userReadRepository, $session);
    }
}
