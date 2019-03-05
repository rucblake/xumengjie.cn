<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/5
 * Time: 16:03
 */

namespace App\Libraries;


use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SQLLog
{
    private static $logger = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$logger) {
            self::$logger = new Logger('sql');
            $handler = new RotatingFileHandler(config('app.log_path') . 'sql.log',
                config('app.log_max_files'), Logger::INFO, false);
            self::$logger->pushHandler($handler);
        }
        return self::$logger;
    }

    public static function write($message, $context = [])
    {
        $logger = self::getInstance();
        $logger->info($message, $context);
    }
}