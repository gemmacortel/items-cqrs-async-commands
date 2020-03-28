<?php

namespace App\Application\Service;

use App\Application\DTO\ItemData;
use App\Domain\Repository\ItemsRepository;

class ListItemsApplicationService
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
     * @return array|null
     */
    public function execute(): array
    {
        $items = $this->itemsRepository->getAll();

        return $this->parsingItemsData($items);
    }

    public function parsingItemsData(array $items): array
    {
        return array_map(
            function($item) {
                return new ItemData($item->getId(), $item->getName(), $item->getQuantity());
            },
            $items
        );
    }
}
