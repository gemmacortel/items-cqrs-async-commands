<?php

namespace App\Application\CreateItem;

class CreateItemCommand
{
    /**
     * @var string
     */
    private $name;


    /**
     * @var int
     */
    private $quantity;

    /**
     * CreateItemCommand constructor.
     * @param string $name
     * @param int $quantity
     */
    public function __construct(string $name, int $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


}
