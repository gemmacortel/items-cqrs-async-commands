<?php

namespace App\UI;

use App\Application\Query;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBus
{
    /**
     * @var MessageBusInterface
     */
    private $queryBus;

    /**
     * ListItemsCommand constructor.
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function dispatch(Query $query)
    {
        $envelope = $this->queryBus->dispatch($query);

        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}
