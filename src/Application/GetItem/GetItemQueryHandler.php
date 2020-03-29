<?php

namespace App\Application\GetItem;

use App\Application\DTO\ItemData;
use App\Domain\ValueObject\ItemId;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetItemQueryHandler implements MessageHandlerInterface
{
    /**
     * @var GetItem
     */
    private $getter;

    /**
     * GetItemQueryHandler constructor.
     * @param GetItem $getter
     */
    public function __construct(GetItem $getter)
    {
        $this->getter = $getter;
    }

    public function __invoke(GetItemQuery $query): ItemData
    {
        $id = new ItemId($query->getId());

        return $this->getter->__invoke($id);
    }
}
