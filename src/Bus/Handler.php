<?php
declare(strict_types=1);

namespace Xgc\Broadway\Bus;

/**
 * Interface Handler
 *
 * @package Xgc\Broadway\Bus
 */
interface Handler
{
    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void;

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response;
}
