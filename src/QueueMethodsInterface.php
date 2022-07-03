<?php

namespace Iamamirsalehi\PhpQueueSystem;

interface QueueMethodsInterface
{
    public function fire(array $queues): bool;
}