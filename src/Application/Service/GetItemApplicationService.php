<?php

namespace App\Application\Service;

use App\Application\DTO\ItemData;
use App\Application\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemsRepository;

class GetItemApplicationService
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
     * @return ItemData
     * @throws ItemNotFoundException
     */
    public function execute(int $id): ItemData
    {
        $item = $this->itemsRepository->search($id);

        if (null === $item) {
            throw new ItemNotFoundException('The item does not exist');
        }

        return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
    }
}
