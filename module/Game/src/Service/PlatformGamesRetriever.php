<?php
declare(strict_types=1);

namespace Game\Service;

use Application\Service\LimitResultsInDevelopment;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\PlatformFilter;
use FreeToGame\Filters\Platforms\Platform;
use FreeToGame\Sort\Sort;

class PlatformGamesRetriever
{
    public static function execute(Platform $platform, Sort $sort): array
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setPlatformFilter(new PlatformFilter($platform));

        $freeToGame = new FreeToGame();

        $games = $freeToGame->fetchList($filterCollection, $sort)->getData();

        return LimitResultsInDevelopment::execute($games);
    }
}
