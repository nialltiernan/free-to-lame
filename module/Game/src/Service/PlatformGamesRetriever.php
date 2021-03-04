<?php
declare(strict_types=1);

namespace Game\Service;

use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\PlatformFilter;
use FreeToGame\Filters\Platforms\Platform;
use FreeToGame\Sort\Sort;

class PlatformGamesRetriever
{
    public static function execute(Platform $platform, Sort $sort)
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setPlatformFilter(new PlatformFilter($platform));

        $freeToGame = new FreeToGame();

        return array_slice($freeToGame->fetchList($filterCollection, $sort)->getData(), 0, 5);
    }
}
