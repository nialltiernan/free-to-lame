<?php
declare(strict_types=1);

namespace Application\Service;

class LimitResultsInDevelopment
{
    public static function execute(array $games): array
    {
        return EnvironmentMode::isDevelopment() ? array_slice($games, 0, 15) : $games;
    }
}
