<?php
declare(strict_types=1);

namespace Xgc\Broadway\Bus;

use RuntimeException;

/**
 * Class ComplexEventBus
 *
 * @package Xgc\Broadway\Bus
 */
class ComplexEventBus implements EventBus
{
    /**
     * @var array
     */
    private $handlerTypes;

    /**
     * @var array
     */
    private $handlers;

    /**
     * @var Response
     */
    private $response;

    /**
     * SimpleEventBus constructor.
     */
    public function __construct()
    {
        $this->handlers     = [];
        $this->handlerTypes = [];
    }

    /**
     * @param string $handlerClass
     * @param string $eventClass
     */
    public function registerHandlerType(string $handlerClass, string $eventClass): void
    {
        $this->handlerTypes[$eventClass] = $handlerClass;
    }

    /**
     * @param Handler|object $object
     *
     * @throws RuntimeException
     */
    public function addHandler(Handler $object): void
    {
        $registered = false;

        foreach ($this->handlerTypes as $type) {
            if (is_a($object, $type)) {
                $this->handlers[$type] = $this->handlers[$type] ?? [];
                $this->register($object, $this->handlers[$type]);
            }
        }

        if (!$registered) {
            throw new RuntimeException('You must register first with HandlerTypes can be used');
        }
    }

    /**
     * @param Handler|object $object
     * @param array          $handlers
     */
    private function register(object $object, array &$handlers): void
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
     *
     * @return null|Response
     *
     * @throws RuntimeException
     */
    public function handle(Event $event): ?Response
    {
        $this->response = null;
        $handlers       = $this->getHandlers($event);
        $method         = get_class_name($event);

        if (count($handlers) === 0) {
            throw new RuntimeException('There is no Handler for this event.');
        }

        if ($event instanceof MonoEvent) {
            if (count($handlers) > 1) {
                throw new RuntimeException('A MonoEvent can only have one handler.');
            }

            $handlers[0]->setResponse(null);
            $handlers[0]->{$method}($event);
            $this->response = $handlers[0]->getResponse();
        } else {
            foreach ($handlers as $handler) {
                $handlers[0]->setResponse(null);
                $handler->{$method}($event);
                $handlers[0]->setResponse(null);
            }
        }

        return $this->response;
    }

    /**
     * @param Event $event
     *
     * @return Handler[]
     */
    private function getHandlers(Event $event): array
    {
        $handlers = [];

        foreach ($this->handlerTypes as $key => $handlerType) {
            if (is_a($event, $key)) {
                $handlers[] = $this->handlers[$handlerType];
            }
        }

        return array_merge(...$this->handlers);
    }
}
