<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \Psr\Log\LoggerInterface channel(string $channel = NULL)
 * @method static \Psr\Log\LoggerInterface stack(array $channels, string $channel = NULL)
 * @method static void alert(string $message, array $context = [])
 * @method static void critical(string $message, array $context = [])
 * @method static void debug(string $message, array $context = [])
 * @method static void emergency(string $message, array $context = [])
 * @method static void error(string $message, array $context = [])
 * @method static void info(string $message, array $context = [])
 * @method static void log($level, string $message, array $context = [])
 * @method static void notice(string $message, array $context = [])
 * @method static void warning(string $message, array $context = [])
 *
 * @see \App\Helpers\ApiLogger
 */

class IndraLoggerFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'IndraLogger';
    }

}
