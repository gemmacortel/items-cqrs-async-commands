<?php

namespace App\Application\SubstractItems;

final class SubstractItemsCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantity;

    /**
     * SubstractItemsCommand constructor.
     * @param int $id
     * @param int $quantity
     */
    public function __construct(int $id, int $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


}
