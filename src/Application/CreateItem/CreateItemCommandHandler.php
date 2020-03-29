<?php

namespace App\Application\CreateItem;

use App\Domain\ValueObject\ItemName;
use App\Domain\ValueObject\ItemQuantity;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateItemCommandHandler implements MessageHandlerInterface
{
    /**
     * @var CreateItem
     */
    private $creator;

    /**
     * CreateItemCommandHandler constructor.
     * @param CreateItem $creator
     */
    public function __construct(CreateItem $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateItemCommand $command)
    {
        $name = new ItemName($command->getName());
        $quantity = new ItemQuantity($command->getQuantity());

        $this->creator->__invoke($name, $quantity);
    }
}
