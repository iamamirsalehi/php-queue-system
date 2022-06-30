<?php

namespace UnitTests;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\QueueService;
use Iamamirsalehi\PhpQueueSystem\QueueStrategies\Redis\RedisQueue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testEnsureWeCanCallFireMethod()
    {
        $queueService = new QueueService();
        $queueService->setQueue(new RedisQueue());
        $queueService->add(new SendEmailToUser(), 'sendEmailToUser', Carbon::now()->addSeconds(10));
        $queueService->fire();
    }
}