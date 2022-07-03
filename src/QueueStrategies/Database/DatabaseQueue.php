<?php

namespace Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database;

use Iamamirsalehi\PhpQueueSystem\Command\QueueCommand;
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

    public function fire(array $queues): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName (action, name, parameters, scheduled_for) VALUES(?, ?, ?, ?)");

        foreach ($queues as $queue) {
            $stmt->execute([
                $queue['action'],
                $queue['name'],
                json_encode($queue['parameters']),
                $queue['scheduled_for'],
            ]);
        }
        return true;
    }
}