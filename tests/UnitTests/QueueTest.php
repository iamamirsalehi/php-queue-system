<?php

namespace Tests\UnitTests;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\QueueService;
use Iamamirsalehi\PhpQueueSystem\QueueStrategies\Database\DatabaseQueue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testEnsureWeCanCallFireMethod()
    {
        $queueService = new QueueService();
        $queueService->setQueue(new DatabaseQueue($this->getPDO(), 'jobs'));
        $queueService->add(new SendEmailToUser(), 'sendEmailToUser', Carbon::now()->addSeconds(10));
        $queueService->fire();
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