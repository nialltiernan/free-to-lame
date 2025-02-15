<?php
declare(strict_types=1);

namespace Game\Service;

use Application\Service\LimitResultsInDevelopment;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\CategoryFilter;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\SearchTerms\SearchTerm;
use FreeToGame\Sort\Sort;

class CategoryGamesRetriever
{
    public static function execute(SearchTerm $searchTerm, Sort $sort): array
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setCategoryFilter(new CategoryFilter($searchTerm));

        $freeToGame = new FreeToGame();

        $games = $freeToGame->fetchList($filterCollection, $sort)->getData();

        return LimitResultsInDevelopment::execute($games);
    }
}
