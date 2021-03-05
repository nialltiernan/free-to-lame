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
use Game\Controller\Category\MilitaryController;
use Game\Controller\Category\MultiplayerOnlineBattleArenaController;
use Game\Controller\Category\OpenWorldController;
use Game\Controller\Category\PermadeathController;
use Game\Controller\Category\PixelController;
use Game\Controller\Category\PlayerVersusEnvironmentController;
use Game\Controller\Category\PlayerVersusPlayerController;
use Game\Controller\Category\RacingController;
use Game\Controller\Category\SailingController;
use Game\Controller\Category\SandboxController;
use Game\Controller\Category\ScienceFictionController;
use Game\Controller\Category\ShooterController;
use Game\Controller\Category\SideScrollerController;
use Game\Controller\Category\SocialController;
use Game\Controller\Category\SpaceController;
use Game\Controller\Category\SportsController;
use Game\Controller\Category\StrategyController;
use Game\Controller\Category\SuperheroController;
use Game\Controller\Category\SurvivalController;
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
                    'military' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/military',
                            'defaults' => [
                                'controller' => MilitaryController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'multiplayer-online-battle-arena' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/multiplayer-online-battle-arena',
                            'defaults' => [
                                'controller' => MultiplayerOnlineBattleArenaController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'open-world' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/open-world',
                            'defaults' => [
                                'controller' => OpenWorldController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'permadeath' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/permadeath',
                            'defaults' => [
                                'controller' => PermadeathController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'pixel' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/pixel',
                            'defaults' => [
                                'controller' => PixelController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'pve' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/pve',
                            'defaults' => [
                                'controller' => PlayerVersusEnvironmentController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'pvp' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/pvp',
                            'defaults' => [
                                'controller' => PlayerVersusPlayerController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'racing' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/racing',
                            'defaults' => [
                                'controller' => RacingController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'sailing' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/sailing',
                            'defaults' => [
                                'controller' => SailingController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'sandbox' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/sandbox',
                            'defaults' => [
                                'controller' => SandboxController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'science-fiction' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/science-fiction',
                            'defaults' => [
                                'controller' => ScienceFictionController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'shooter' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/shooter',
                            'defaults' => [
                                'controller' => ShooterController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'side-scroller' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/side-scroller',
                            'defaults' => [
                                'controller' => SideScrollerController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'social' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/social',
                            'defaults' => [
                                'controller' => SocialController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'space' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/space',
                            'defaults' => [
                                'controller' => SpaceController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'sports' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/sorts',
                            'defaults' => [
                                'controller' => SportsController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'strategy' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/strategy',
                            'defaults' => [
                                'controller' => StrategyController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'superhero' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/superhero',
                            'defaults' => [
                                'controller' => SuperheroController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'survival' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/survival',
                            'defaults' => [
                                'controller' => SurvivalController::class,
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
            MilitaryController::class => InvokableFactory::class,
            MultiplayerOnlineBattleArenaController::class => InvokableFactory::class,
            OpenWorldController::class => InvokableFactory::class,
            PermadeathController::class => InvokableFactory::class,
            PixelController::class => InvokableFactory::class,
            PlayerVersusEnvironmentController::class => InvokableFactory::class,
            PlayerVersusPlayerController::class => InvokableFactory::class,
            RacingController::class => InvokableFactory::class,
            SailingController::class => InvokableFactory::class,
            SandboxController::class => InvokableFactory::class,
            ScienceFictionController::class => InvokableFactory::class,
            ShooterController::class => InvokableFactory::class,
            SideScrollerController::class => InvokableFactory::class,
            SocialController::class => InvokableFactory::class,
            SpaceController::class => InvokableFactory::class,
            SportsController::class => InvokableFactory::class,
            StrategyController::class => InvokableFactory::class,
            SuperheroController::class => InvokableFactory::class,
            SurvivalController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
