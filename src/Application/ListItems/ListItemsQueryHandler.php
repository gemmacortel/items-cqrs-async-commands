<?php

namespace App\Application\ListItems;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ListItemsQueryHandler implements MessageHandlerInterface
{
    /**
     * @var ListItems
     */
    private $lister;

    /**
     * ListItemsQueryHandler constructor.
     * @param ListItems $lister
     */
    public function __construct(ListItems $lister)
    {
        $this->lister = $lister;
    }

    public function __invoke(ListItemsQuery $query)
    {
        return $this->lister->__invoke();
    }
}
