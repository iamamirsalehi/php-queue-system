<?php

namespace Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\QueueMethodsInterface;

class DatabaseQueue implements QueueMethodsInterface
{
    /**@var \PDO $pdo */
    private $pdo;

    private $tableName;

    public function __construct(\PDO $pdo, string $tableName)
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
    }

    public function fire(array $queues)
    {
        // insert into table
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName (action, name, scheduled_for) VALUES(?, ?, ?)");
        foreach ($queues as $queue) {
            $stmt->execute([
                $queue['action'],
                $queue['name'],
                Carbon::parse($queue['scheduled_for'])->format('Y-m-d H:i:s'),
            ]);
        }
    }
}