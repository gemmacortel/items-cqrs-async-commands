<?php

namespace App\Application\CreateItem;

use App\Application\DTO\ItemData;
use App\Domain\Entity\Item;
use App\Domain\Repository\ItemsRepository;
use App\Domain\ValueObject\ItemName;
use App\Domain\ValueObject\ItemQuantity;

class CreateItem
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
     * @param ItemName $name
     * @param ItemQuantity $quantity
     * @return void
     */
    public function __invoke(ItemName $name, ItemQuantity $quantity): void
    {
        $item = new Item($name, $quantity->getValue());

        $this->itemsRepository->save($item);
    }
}
