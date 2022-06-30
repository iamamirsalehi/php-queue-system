<?php

namespace Iamamirsalehi\PhpQueueSystem\Models;

use Carbon\Carbon;
use Iamamirsalehi\PhpQueueSystem\Abstracts\ActionInterface;

class Queues
{
    /**@var string $name */
    private $name;

    /**@var ActionInterface $action */
    private $action;

    /**@var Carbon|null $scheduleFor */
    private $scheduleFor;

    public function __construct(ActionInterface $action, string $name = 'default', Carbon $scheduleFor = null)
    {
        $this->name = $name;
        $this->action = $action;
        $this->scheduleFor = $scheduleFor;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ActionInterface
     */
    public function getAction(): ActionInterface
    {
        return $this->action;
    }

    /**
     * @return Carbon|null
     */
    public function getScheduleFor(): ?Carbon
    {
        return $this->scheduleFor;
    }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'name' => $this->name,
            'schedule_for' => $this->scheduleFor,
        ];
    }

}