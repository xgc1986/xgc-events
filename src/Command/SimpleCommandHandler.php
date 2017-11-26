<?php
declare(strict_types=1);

namespace Xgc\Broadway\Command;

use Xgc\Broadway\Bus\Response;

/**
 * Class SimpleCommandHandler
 *
 * @package Xgc\Broadway\Command
 */
class SimpleCommandHandler implements CommandHandler
{
    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void
    {
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return null;
    }
}
