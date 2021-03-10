<?php

use Laminas\Router\Http\Literal;
use User\Controller\UserController;
use User\Factory\UserControllerFactory;
use User\Factory\UserReadRepositoryFactory;
use User\Repository\UserReadRepository;
use User\Repository\UserReadRepositoryInterface;

return [
    'service_manager' => [
        'aliases' => [
            UserReadRepositoryInterface::class => UserReadRepository::class,
        ],
        'factories' => [
            UserReadRepository::class => UserReadRepositoryFactory::class,
        ]
    ],
    'router' => [
        'routes' => [
            'users' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/users',
                    'defaults' => [
                        'controller' => UserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            UserController::class => UserControllerFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
