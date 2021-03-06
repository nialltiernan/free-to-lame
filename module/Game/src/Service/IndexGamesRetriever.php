<?php
declare(strict_types=1);

namespace Game\Service;

use FreeToGame\Client as FreeToGame;
use FreeToGame\Sort\PopularitySort;

class IndexGamesRetriever
{
    public static function execute(): array
    {
        $freeToGame = new FreeToGame();

        $popularitySort = new PopularitySort();

        return $freeToGame->fetchList(null, $popularitySort)->getData();
    }
}
