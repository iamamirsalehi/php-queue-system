<?php

namespace Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database;

class Connection
{
    private $driver;
    private $host;
    private $db;
    private $user;
    private $password;

    private $pdo;

    public function __construct(string $driver, string $host, string $db, string $user, string $password)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;

        $this->pdo = new \PDO($this->getDsn(), $this->user, $password);
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }

    private function getDsn(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=UTF8", $this->driver, $this->host, $this->db);
    }
}