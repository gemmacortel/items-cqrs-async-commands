<?php

namespace App\Application\SubstractItems;

use App\Domain\ValueObject\ItemId;
use App\Domain\ValueObject\ItemQuantity;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SubstractItemsCommandHandler implements MessageHandlerInterface
{
    /**
     * @var SubstractItems
     */
    private $substractor;


    public function __construct(SubstractItems $substractor)
    {
        $this->substractor = $substractor;
    }


    public function __invoke(SubstractItemsCommand $command)
    {
        $id = new ItemId($command->getId());
        $quantity = new ItemQuantity($command->getQuantity());

        $this->substractor->__invoke($id, $quantity);
    }
}
