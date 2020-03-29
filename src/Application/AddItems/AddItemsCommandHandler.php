<?php

namespace App\Application\AddItems;

use App\Domain\ValueObject\ItemId;
use App\Domain\ValueObject\ItemQuantity;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddItemsCommandHandler implements MessageHandlerInterface
{
    /**
     * @var AddItems
     */
    private $adder;

    /**
     * SubstractItemsCommandHandler constructor.
     * @param AddItems $adder
     */
    public function __construct(AddItems $adder)
    {
        $this->adder = $adder;
    }

    public function __invoke(AddItemsCommand $command)
    {
        $id = new ItemId($command->getId());
        $quantity = new ItemQuantity($command->getQuantity());

        $this->adder->__invoke($id, $quantity);
    }
}
