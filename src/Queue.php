<?php

namespace Iamamirsalehi\PhpQueueSystem;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\Abstracts\ActionInterface;
use Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database\Connection;
use Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database\DatabaseQueue;

class Queue
{
    public static function pushOn(ActionInterface $action, array $parameters = [], Carbon $scheduleFor = null, string $name = 'default'): bool
    {
        $queueDriver = strtolower($_ENV['driver']);
        return self::$queueDriver($action, $parameters, $scheduleFor, $name);
    }

    private static function database(ActionInterface $action, array $parameters = [], Carbon $scheduleFor = null, string $name = 'default'): bool
    {
        $pdo = new Connection('mysql', '127.0.0.1', 'queue', 'root', '');
        $database = new DatabaseQueue($pdo->getConnection(), 'jobs');
        $database->fire([
            [
                'action' => get_class($action),
                'name' => $name,
                'parameters' => implode(',', $parameters),
                'scheduled_for' => is_null($scheduleFor) ?: $scheduleFor->format('Y-m-d H:i:s')
            ]
        ]);
        return true;
    }
}