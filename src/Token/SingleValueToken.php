<?php
namespace Hasu94\Calculator\Token;

class SingleValueToken implements TokenInterface
{

    /**
     *
     * @var float
     */
    private $value;

    private function __construct(float $value)
    {
        $this->value = $value;
    }

    public static function create(float $value)
    {
        return new static($value);
    }

    public function evaluate(): float
    {
        return $this->value;
    }
}