<?php
namespace Hasu94\Calculator\Parser;

use Hasu94\Calculator\Token\TokenInterface;

interface MathStringParserInterface
{

    public function parse(string $string): TokenInterface;
}