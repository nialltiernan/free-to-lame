<?php
declare(strict_types=1);

namespace Game\Factory;

use FreeToGame\Sort\AlphabeticalSort;
use FreeToGame\Sort\PopularitySort;
use FreeToGame\Sort\ReleaseDateSort;
use FreeToGame\Sort\RelevanceSort;
use FreeToGame\Sort\Sort;

class SortFactory
{
    public static function getSort(string $sortBy): Sort
    {
        if ($sortBy === 'alphabetical') {
            $sort = new AlphabeticalSort();
        } elseif ($sortBy === 'popularity') {
            $sort = new PopularitySort();
        } elseif ($sortBy === 'release-date') {
            $sort = new ReleaseDateSort();
        } else {
            $sort = new RelevanceSort();
        }
        return $sort;
    }
}
