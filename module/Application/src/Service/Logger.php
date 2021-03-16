<?php
declare(strict_types=1);

namespace Application\Service;

use Laminas\Log\Logger as LaminasLogger;
use Laminas\Log\Writer\Stream;

class Logger
{
    public static function debug($message)
    {
        $logger = new LaminasLogger();

        $file = new Stream('data/debug.log');

        $logger->addWriter($file);

        $logger->log(LaminasLogger::DEBUG, $message);
    }
}
