<?php
declare(strict_types=1);

namespace Xgc\Broadway\Bus;

use Xgc\Broadway\Command\Command;
use Xgc\Broadway\Command\CommandHandler;
use Xgc\Broadway\Query\Query;
use Xgc\Broadway\Query\QueryHandler;

/**
 * Class CQRSEventBus
 *
 * @package Xgc\Broadway\Bus
 */
class CQRSEventBus extends ComplexEventBus
{
    public function __construct()
    {
        $this->registerHandlerType(CommandHandler::class, Command::class);
        $this->registerHandlerType(QueryHandler::class, Query::class);
    }
}
