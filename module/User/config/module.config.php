<?php

use Laminas\Router\Http\Literal;
use User\Controller\UserController;
use User\Factory\UserControllerFactory;
use User\Factory\UserRepositoryFactory;
use User\Repository\UserRepository;
use User\Repository\UserRepositoryInterface;

return [
    'service_manager' => [
        'aliases' => [
            UserRepositoryInterface::class => UserRepository::class,
        ],
        'factories' => [
            UserRepository::class => UserRepositoryFactory::class,
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
