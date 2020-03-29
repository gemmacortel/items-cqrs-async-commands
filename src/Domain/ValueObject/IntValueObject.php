<?php

namespace App\Domain\ValueObject;

abstract class IntValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * IntValueObject constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }


}
