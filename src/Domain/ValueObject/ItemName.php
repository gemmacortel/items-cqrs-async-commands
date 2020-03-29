<?php

namespace App\Domain\ValueObject;

class ItemName
{
    /**
     * @var string
     */
    private $value;

    /**
     * ItemName constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
