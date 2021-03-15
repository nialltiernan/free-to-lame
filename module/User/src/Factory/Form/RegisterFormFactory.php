<?php
declare(strict_types=1);

namespace User\Factory\Form;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Form\RegisterForm;

class RegisterFormFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options['db'] = $container->get(DatabaseAdapter::class);

        return new RegisterForm('register', $options);
    }
}
