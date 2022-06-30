<?php

namespace Iamamirsalehi\PhpQueueSystem;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\Abstracts\ActionInterface;

//TODO: Cache the order in a file

class QueueService
{
    /**@var array $queues */
    private $queues;

    /**@var QueueMethodsInterface $queueMethod */
    private $queueMethod;

    public function setQueue(QueueMethodsInterface $queueMethod)
    {
        $this->queueMethod = $queueMethod;
    }

    public function add(ActionInterface $action, string $name = 'default', Carbon $scheduleFor = null): self
    {
        $this->queues[] = [
            'action' => get_class($action),
            'name' => $name,
            'scheduled_for' => $scheduleFor,
        ];

        return $this;
    }

    public function addMultiple(array $queues)
    {
        foreach ($queues as $queue) {
            $this->queues[] = [
                'action' => $queue['action'],
                'name' => $queue['name'],
                'scheduled_for' => $queue['scheduled_for'],
            ];;
        }
    }

    public function fire()
    {
        $this->queueMethod->fire($this->queues);
    }
}
