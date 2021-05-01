<?php
declare(strict_types=1);

namespace Application\Service;

class EnvironmentMode
{
    public static function isProduction(): bool
    {
        return getenv('APP_ENV') === 'production';
    }

    public static function isDevelopment(): bool
    {
        return !self::isProduction();
    }
}
