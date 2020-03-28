<?php

namespace App\Application\Service;

use App\Application\DTO\ItemData;
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
     * @throws \Exception
     */
    public function execute(int $id): ItemData
    {
        $item = $this->itemsRepository->search($id);

        if (null === $item) {
            throw new \Exception('The item does not exist');
        }

        return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
    }
}
