<?php

namespace App\Application\AddItems;

use App\Application\DTO\ItemData;
use App\Application\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemsRepository;
use App\Domain\ValueObject\ItemId;
use App\Domain\ValueObject\ItemQuantity;

class AddItems
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
     * @param ItemQuantity $quantity
     * @return void
     */
    public function __invoke(ItemId $id, ItemQuantity $quantity): void
    {
        $item = $this->itemsRepository->search($id->getValue());

        if (null !== $item) {
            $this->retrieve($quantity->getValue(), $item);
        }
    }

    /**
     * @param int $quantity
     * @param \App\Domain\Entity\Item|null $item
     */
    protected function retrieve(int $quantity, ?\App\Domain\Entity\Item $item): void
    {
        $item->add($quantity);
        $this->itemsRepository->save($item);
    }
}
