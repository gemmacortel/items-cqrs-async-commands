<?php

namespace App\Application\DeleteItem;

use App\Domain\Repository\ItemsRepository;
use App\Domain\ValueObject\ItemId;

class DeleteItem
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
     * @return void
     */
    public function __invoke(ItemId $id): void
    {
        $item = $this->itemsRepository->search($id->getValue());

        if (null !== $item) {
            $this->itemsRepository->delete($item);
        }
    }
}
