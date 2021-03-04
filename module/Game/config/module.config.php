<?php

use Game\Controller\Category\ActionController;
use Game\Controller\Category\ActionRolePlayingGameController;
use Game\Controller\Category\AnimeController;
use Game\Controller\Category\BattleRoyaleController;
use Game\Controller\Category\CardController;
use Game\Controller\Category\FantasyController;
use Game\Controller\Category\FightingController;
use Game\Controller\Category\FirstPersonController;
use Game\Controller\Category\FlightController;
use Game\Controller\Category\HorrorController;
use Game\Controller\Category\LowSpecificationsController;
use Game\Controller\Category\MartialArtsController;
use Game\Controller\Category\MassivelyMultiplayerOnlineController;
use Game\Controller\Category\MassivelyMultiplayerOnlineFirstPersonShooterController;
use Game\Controller\Category\MassivelyMultiplayerOnlineRealTimeStrategyController;
use Game\Controller\Category\MassivelyMultiplayerOnlineRolePlayingGameController;
use Game\Controller\Category\MassivelyMultiplayerOnlineThirdPersonShooterController;
use Game\Controller\CategoryController;
use Game\Controller\GameController;
use Game\Controller\IndexController;
use Game\Controller\Platform\BrowserController;
use Game\Controller\Platform\PcController;
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
                                'controller' => BrowserController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'pc' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/pc',
                            'defaults' => [
                                'controller' => PcController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'categories' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/categories',
                    'defaults' => [
                        'controller' => CategoryController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'action' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/action',
                            'defaults' => [
                                'controller' => ActionController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'action-role-playing-game' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/action-role-playing-game',
                            'defaults' => [
                                'controller' => ActionRolePlayingGameController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'anime' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/anime',
                            'defaults' => [
                                'controller' => AnimeController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'battle-royale' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/battle-royale',
                            'defaults' => [
                                'controller' => BattleRoyaleController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'card' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/card',
                            'defaults' => [
                                'controller' => CardController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'fighting' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/fighting',
                            'defaults' => [
                                'controller' => FlightController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'first-person' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/first-person',
                            'defaults' => [
                                'controller' => FirstPersonController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'flight' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/flight',
                            'defaults' => [
                                'controller' => FlightController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'horror' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/horror',
                            'defaults' => [
                                'controller' => HorrorController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'low-specifications' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/low-specifications',
                            'defaults' => [
                                'controller' => LowSpecificationsController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'martial-arts' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/martial-arts',
                            'defaults' => [
                                'controller' => MartialArtsController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'mmo' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/mmo',
                            'defaults' => [
                                'controller' => MassivelyMultiplayerOnlineController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'mmofps' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/mmofps',
                            'defaults' => [
                                'controller' => MassivelyMultiplayerOnlineFirstPersonShooterController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'mmorts' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/mmorts',
                            'defaults' => [
                                'controller' => MassivelyMultiplayerOnlineRealTimeStrategyController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'mmorpg' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/mmorpg',
                            'defaults' => [
                                'controller' => MassivelyMultiplayerOnlineRolePlayingGameController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'mmotps' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/mmotps',
                            'defaults' => [
                                'controller' => MassivelyMultiplayerOnlineThirdPersonShooterController::class,
                                'action' => 'index',
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
            GameController::class => InvokableFactory::class,
            BrowserController::class => InvokableFactory::class,
            PcController::class => InvokableFactory::class,
            CategoryController::class => InvokableFactory::class,
            ActionController::class => InvokableFactory::class,
            ActionRolePlayingGameController::class => InvokableFactory::class,
            AnimeController::class => InvokableFactory::class,
            BattleRoyaleController::class => InvokableFactory::class,
            CardController::class => InvokableFactory::class,
            FantasyController::class => InvokableFactory::class,
            FightingController::class => InvokableFactory::class,
            FirstPersonController::class => InvokableFactory::class,
            FlightController::class => InvokableFactory::class,
            HorrorController::class => InvokableFactory::class,
            LowSpecificationsController::class => InvokableFactory::class,
            MartialArtsController::class => InvokableFactory::class,
            MassivelyMultiplayerOnlineController::class => InvokableFactory::class,
            MassivelyMultiplayerOnlineFirstPersonShooterController::class => InvokableFactory::class,
            MassivelyMultiplayerOnlineRealTimeStrategyController::class => InvokableFactory::class,
            MassivelyMultiplayerOnlineRolePlayingGameController::class => InvokableFactory::class,
            MassivelyMultiplayerOnlineThirdPersonShooterController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
