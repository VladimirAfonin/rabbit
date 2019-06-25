<?php
declare(strict_types=1);

namespace Api\Infrastructure\Model\EventDispatcher;
interface EventDispatcher
{
    public function dispatch(...$events): void;
}