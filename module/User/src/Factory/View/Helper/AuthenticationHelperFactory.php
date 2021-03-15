<?php
declare(strict_types=1);

namespace User\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\AuthenticationService;
use User\View\Helper\AuthenticationHelper;

class AuthenticationHelperFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = $container->get(AuthenticationService::class);

        return new AuthenticationHelper($service);
    }
}
