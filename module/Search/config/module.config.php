<?php

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Search\Controller\SearchResultsController;

return [
    'router' => [
        'routes' => [
            'search-results' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/search-results',
                    'defaults' => [
                        'controller' => SearchResultsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            SearchResultsController::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
