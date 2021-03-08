<?php
declare(strict_types=1);

namespace Game\Service;

use Application\Service\EnvironmentMode;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\CategoryFilter;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\SearchTerms\SearchTerm;
use FreeToGame\Sort\Sort;

class CategoryGamesRetriever
{
    public static function execute(SearchTerm $searchTerm, Sort $sort)
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setCategoryFilter(new CategoryFilter($searchTerm));

        $freeToGame = new FreeToGame();

        $games = $freeToGame->fetchList($filterCollection, $sort)->getData();

        if (EnvironmentMode::isLocal()) {
            $games = array_slice($games, 0, 15);
        }

        return $games;
    }
}
