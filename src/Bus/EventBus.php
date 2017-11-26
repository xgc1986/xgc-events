<?php
declare(strict_types=1);

namespace Xgc\Broadway\Bus;

/**
 * Interface EventBus
 */
interface EventBus
{
    /**
     * @param Handler $object
     */
    public function addHandler(Handler $object): void;

    /**
     * @param Event $object
     */
    public function handle(Event $object): void;
}
