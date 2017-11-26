<?php
declare(strict_types=1);

namespace Xgc\Broadway\Query;

use Xgc\Broadway\Bus\Response;

/**
 * Class SimpleQueryHandler
 *
 * @package Xgc\Broadway\Query
 */
class SimpleQueryHandler implements QueryHandler
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
