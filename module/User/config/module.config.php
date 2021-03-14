<?php

use Laminas\Authentication\AuthenticationService as LaminasAuthenticationService;
use Laminas\Router\Http\Literal;
use User\Controller\AuthController;
use User\Controller\UserController;
use User\Factory\AuthControllerFactory;
use User\Factory\AuthenticationServiceFactory;
use User\Factory\LoginFormFactory;
use User\Factory\RegisterFormFactory;
use User\Factory\UserControllerFactory;
use User\Factory\UserReadRepositoryFactory;
use User\Factory\UserWriteRepositoryFactory;
use User\Form\LoginForm;
use User\Form\RegisterForm;
use User\Repository\UserReadRepository;
use User\Repository\UserReadRepositoryInterface;
use User\Repository\UserWriteRepository;
use User\Repository\UserWriteRepositoryInterface;
use User\Service\AuthenticationService;

return [
    'service_manager' => [
        'aliases' => [
            UserReadRepositoryInterface::class => UserReadRepository::class,
            UserWriteRepositoryInterface::class => UserWriteRepository::class,
            LaminasAuthenticationService::class => AuthenticationService::SERVICE_NAME
        ],
        'invokables' => [
            AuthenticationService::SERVICE_NAME => AuthenticationService::class,
        ],
        'factories' => [
            UserReadRepository::class => UserReadRepositoryFactory::class,
            UserWriteRepository::class => UserWriteRepositoryFactory::class,
            RegisterForm::class => RegisterFormFactory::class,
            LoginForm::class => LoginFormFactory::class,
            AuthenticationService::class => AuthenticationServiceFactory::class
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
            'register' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/register',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'register',
                    ],
                ],
            ],
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            UserController::class => UserControllerFactory::class,
            AuthController::class => AuthControllerFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
