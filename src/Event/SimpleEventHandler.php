<?php
declare(strict_types=1);

namespace Xgc\Broadway\Event;

use Xgc\Broadway\Bus\Response;

/**
 * Class SimpleEventHandler
 *
 * @package Xgc\Broadway\Event
 */
class SimpleEventHandler implements EventHandler
{
    /**
     * @var Response|null
     */
    private $response;

    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }
}
