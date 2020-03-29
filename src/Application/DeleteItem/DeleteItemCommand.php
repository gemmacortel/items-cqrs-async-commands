<?php

namespace App\Application\DeleteItem;

class DeleteItemCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * DeleteItemCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}
