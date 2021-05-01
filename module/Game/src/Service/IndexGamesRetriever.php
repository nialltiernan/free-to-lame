<?php
declare(strict_types=1);

namespace Game\Service;

use Application\Service\LimitResultsInDevelopment;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Sort\PopularitySort;

class IndexGamesRetriever
{
    public static function execute(): array
    {
        $freeToGame = new FreeToGame();

        $popularitySort = new PopularitySort();

        $games = $freeToGame->fetchList(null, $popularitySort)->getData();

        return LimitResultsInDevelopment::execute($games);
    }
}
