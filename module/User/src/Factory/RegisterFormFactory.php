<?php
declare(strict_types=1);

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Form\RegisterForm;

class RegisterFormFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options['adapter'] = $container->get(AdapterInterface::class);

        return new RegisterForm('register', $options);
    }
}
