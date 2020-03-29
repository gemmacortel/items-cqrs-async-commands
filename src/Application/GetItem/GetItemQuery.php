<?php

namespace App\Application\GetItem;

class GetItemQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetItemQuery constructor.
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
