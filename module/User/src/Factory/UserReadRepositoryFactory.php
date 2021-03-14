<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Repository\UserReadRepository;

class UserReadRepositoryFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $db = $container->get(DatabaseAdapter::class);

        $hydrator = new ClassMethodsHydrator();

        return new UserReadRepository($db, $hydrator);
    }
}
