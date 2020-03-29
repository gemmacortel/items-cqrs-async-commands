<?php

namespace App\Application\Service;

use App\Application\DTO\ItemData;
use App\Application\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemsRepository;

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
     * @param int $id
     * @param int $quantity
     * @return ItemData
     * @throws ItemNotFoundException
     */
    public function execute(int $id, int $quantity)
    {
        $item = $this->itemsRepository->search($id);

        if (null === $item) {
            throw new ItemNotFoundException('The item does not exist');
        }

        $this->retrieve($quantity, $item);

        return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
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
