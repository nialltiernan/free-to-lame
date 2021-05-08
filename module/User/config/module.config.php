<?php

use Laminas\Authentication\AuthenticationService as LaminasAuthenticationService;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use User\Controller\AuthController;
use User\Controller\Plugin\UserColorPlugin;
use User\Controller\UserController;
use User\Factory\Controller\AuthControllerFactory;
use User\Factory\View\Helper\AuthenticationHelperFactory;
use User\Factory\Service\AuthenticationServiceFactory;
use User\Factory\Form\LoginFormFactory;
use User\Factory\Form\RegisterFormFactory;
use User\Factory\Controller\UserControllerFactory;
use User\Factory\Repository\UserReadRepositoryFactory;
use User\Factory\Repository\UserWriteRepositoryFactory;
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
            'logout' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'logout',
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

    'controller_plugins' => [
        'factories' => [
            UserColorPlugin::class => InvokableFactory::class,
        ],
        'aliases' => [
            UserColorPlugin::NAME => UserColorPlugin::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'authentication' => AuthenticationHelperFactory::class
        ]
    ],
];
