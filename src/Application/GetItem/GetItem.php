<?php

namespace App\Application\GetItem;

use App\Application\DTO\ItemData;
use App\Application\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemsRepository;
use App\Domain\ValueObject\ItemId;

class GetItem
{
    /**
     * @var ItemsRepository
     */
    private $itemsRepository;

    public function __construct(ItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    /**
     * @param ItemId $id
     * @return ItemData
     * @throws ItemNotFoundException
     */
    public function __invoke(ItemId $id): ItemData
    {
        $item = $this->itemsRepository->search($id->getValue());

        if (null === $item) {
            throw new ItemNotFoundException('The item does not exist');
        }

        return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
    }
}
