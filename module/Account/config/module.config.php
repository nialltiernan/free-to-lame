<?php

use Account\Controller\AccountController;
use Account\Factory\Controller\AccountControllerFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'account' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/account/:userId',
                    'constraints' => [
                        'useId'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => AccountController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'json' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/json',
                            'defaults' => [
                                'controller' => AccountController::class,
                                'action' => 'indexJson',
                            ],
                        ],
                    ],
                    'update' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/update',
                            'defaults' => [
                                'controller' => AccountController::class,
                                'action'     => 'updateUser',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => AccountController::class,
                                'action'     => 'deleteUser',
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            AccountController::class => AccountControllerFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
