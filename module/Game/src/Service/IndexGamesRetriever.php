<?php
declare(strict_types=1);

namespace Game\Service;

use Application\Service\EnvironmentMode;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Sort\PopularitySort;

class IndexGamesRetriever
{
    public static function execute(): array
    {
        $freeToGame = new FreeToGame();

        $popularitySort = new PopularitySort();

        $games = $freeToGame->fetchList(null, $popularitySort)->getData();

        if (EnvironmentMode::isLocal()) {
            $games = array_slice($games, 0, 15);
        }

        return $games;
    }
}
