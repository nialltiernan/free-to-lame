<?php

use Game\Controller\CategoryController;
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
                'may_terminate' => true,
                'child_routes' => [
                    'json' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => 'json',
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'indexJson',
                            ],
                        ],
                    ]
                ]
            ],
            'platform' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/platform/:platform',
                    'constraints' => [
                        'platform' => '[-a-z]+'
                    ],
                    'defaults' => [
                        'controller' => PlatformController::class,
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
                                'controller' => PlatformController::class,
                                'action' => 'indexJson',
                            ],
                        ],
                    ]
                ],
            ],
            'platforms' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/platforms',
                    'defaults' => [
                        'controller' => PlatformController::class,
                        'action'     => 'list',
                    ],
                ],
            ],
            'category' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/category/:category',
                    'constraints' => [
                        'category' => '[-a-z]+'
                    ],
                    'defaults' => [
                        'controller' => CategoryController::class,
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
                                'controller' => CategoryController::class,
                                'action' => 'indexJson',
                            ],
                        ],
                    ]
                ]
            ],
            'categories' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/categories',
                    'defaults' => [
                        'controller' => CategoryController::class,
                        'action'     => 'list',
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
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'json' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/json',
                            'defaults' => [
                                'controller' => GameController::class,
                                'action' => 'detailsJson',
                            ],
                        ],
                    ]
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
            PlatformController::class => InvokableFactory::class,
            GameController::class => InvokableFactory::class,
            CategoryController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
