<?php

namespace Tests\UnitTests;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\Queue;
use Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database\DatabaseQueue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testEnsureWeCanCallFireMethod()
    {
        $_ENV['driver'] = 'database';

        $this->assertTrue(Queue::pushOn(new SendEmailToUser()));
    }

    private function getPDO(): \PDO
    {
        return new \PDO(
            sprintf("%s:host=%s;dbname=%s;charset=UTF8", 'mysql', 'localhost', 'queue'),
            'root',
            ''
        );
    }
}