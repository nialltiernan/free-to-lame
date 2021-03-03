<?php

use Game\Controller\GameController;
use Game\Controller\IndexController;
use Game\Controller\PlatformController;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'homepage' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'platforms' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/platforms',
                    'defaults' => [
                        'controller' => PlatformController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'browser' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/browser',
                            'defaults' => [
                                'action' => 'browser',
                            ],
                        ],
                    ],
                    'pc' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/pc',
                            'defaults' => [
                                'action' => 'pc',
                            ],
                        ],
                    ],
                ],
            ],
            'game' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/game/:id',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => GameController::class,
                        'action' => 'details'
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
            PlatformController::class => InvokableFactory::class,
            GameController::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
