<?php

namespace App\Application\Service;

use App\Application\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemsRepository;

class DeleteItemApplicationService
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
     * @return void
     * @throws ItemNotFoundException
     */
    public function execute(int $id): void
    {
        $item = $this->itemsRepository->search($id);

        if (null === $item) {
            throw new ItemNotFoundException('The item does not exist');
        }

        $this->itemsRepository->delete($item);
    }
}
