<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Item;

interface ItemsRepository
{
    public function search(int $id): ?Item ;

    public function getAll(): array;

    public function save(Item $item): void;

}
