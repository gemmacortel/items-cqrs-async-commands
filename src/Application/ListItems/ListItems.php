<?php

namespace App\Application\ListItems;

use App\Application\DTO\ItemData;
use App\Domain\Repository\ItemsRepository;

class ListItems
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
    public function __invoke(): array
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
