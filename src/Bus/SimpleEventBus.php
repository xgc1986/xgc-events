<?php
declare(strict_types=1);

namespace Xgc\Broadway\Bus;

use RuntimeException;

/**
 * Class SimpleEventBus
 *
 * @package Xgc\Broadway\Bus
 */
class SimpleEventBus implements EventBus
{

    /**
     * @var array
     */
    private $handlers;

    /**
     * SimpleEventBus constructor.
     */
    public function __construct()
    {
        $this->handlers = [];
    }

    /**
     * @param Handler|object $object
     *
     * @throws RuntimeException
     */
    public function addHandler(Handler $object): void
    {
        $methods = get_class_methods($object);

        foreach ($methods as $method) {
            if (0 === strpos($method, 'handle')) {
                $func              = substr($method, 6);
                $handlers[$func]   = $handlers[$func] ?? [];
                $handlers[$func][] = $object;
            }
        }
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event): void
    {
        /** @var Handler[] $handlers */
        $handlers = $this->handlers[get_class_name($event)];
        $method   = get_class_name($event);

        foreach ($handlers as $handler) {
            $handlers[0]->setResponse(null);
            $handler->{$method}($event);
            $handlers[0]->setResponse(null);
        }

    }

    /**
     * @return null|Response
     */
    public function getResponse(): ?Response
    {
        return null;
    }
}
