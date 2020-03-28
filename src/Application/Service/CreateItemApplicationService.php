<?php

namespace App\Application\Service;

use App\Application\DTO\ItemData;
use App\Domain\Entity\Item;
use App\Domain\Repository\ItemsRepository;

class CreateItemApplicationService
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
     * @param string $name
     * @param int $quantity
     * @return ItemData
     */
    public function execute(string $name, int $quantity): ItemData
    {
        $item = $this->createNewItem($name, $quantity);

        return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
    }

    /**
     * @param string $name
     * @param int $quantity
     * @return Item
     */
    protected function createNewItem(string $name, int $quantity): Item
    {
        $item = new Item($name, $quantity);
        $this->itemsRepository->save($item);

        return $item;
    }
}
