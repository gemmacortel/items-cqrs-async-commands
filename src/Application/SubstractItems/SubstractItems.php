<?php

namespace App\Application\SubstractItems;

use App\Domain\Entity\Item;
use App\Domain\Repository\ItemsRepository;
use App\Domain\ValueObject\ItemId;
use App\Domain\ValueObject\ItemQuantity;

class SubstractItems
{
    /**
     * @var ItemsRepository
     */
    private $itemsRepository;

    public function __construct(ItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    public function __invoke(ItemId $id, ItemQuantity $quantity):void
    {
        $item = $this->itemsRepository->search($id->getValue());

        if (null !== $item) {
            $this->retrieve($quantity->getValue(), $item);
        }
    }

    /**
     * @param int $quantity
     * @param Item $item
     */
    protected function retrieve(int $quantity, Item $item): void
    {
        $item->retrieve($quantity);
        $this->itemsRepository->save($item);
    }
}
