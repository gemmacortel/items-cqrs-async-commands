<?php

namespace App\Application\DeleteItem;

use App\Domain\ValueObject\ItemId;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteItemCommandHandler implements MessageHandlerInterface
{
    /**
     * @var DeleteItem
     */
    private $deleter;

    /**
     * DeleteItemCommandHandler constructor.
     * @param DeleteItem $deleter
     */
    public function __construct(DeleteItem $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteItemCommand $command)
    {
        $id = new ItemId($command->getId());

        $this->deleter->__invoke($id);
    }
}
