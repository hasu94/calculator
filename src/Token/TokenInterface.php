<?php
namespace Hasu94\Calculator\Token;

interface TokenInterface
{

    public function evaluate(): float;
}