<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Repository\UserWriteRepository;

class UserWriteRepositoryFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $db = $container->get(DatabaseAdapter::class);

        return new UserWriteRepository($db);
    }
}
