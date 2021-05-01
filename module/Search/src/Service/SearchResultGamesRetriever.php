<?php
declare(strict_types=1);

namespace Search\Service;

use Application\Service\EnvironmentMode;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\TagFilter;
use FreeToGame\Helpers\SearchTermFactory;

class SearchResultGamesRetriever
{
    public static function execute(array $searchTerms): array
    {
        $searchTerms = SearchTermFactory::getSearchTerms($searchTerms);

        $tagFilter = new TagFilter($searchTerms);

        $filterCollection = new FilterCollection();

        $filterCollection->setTagFilter($tagFilter);

        $freeToGame = new FreeToGame();

        $games = $freeToGame->fetchList($filterCollection)->getData();

        if (EnvironmentMode::isDevelopment()) {
            $games = array_slice($games, 0, 15);
        }

        return $games;
    }


}
