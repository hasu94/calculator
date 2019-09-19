<?php
namespace Hasu94\Calculator\Token\Factory;

use Hasu94\Calculator\Token\SingleValueToken;

class SingleValueTokenArrayFactory
{

    /**
     *
     * @param string[] $numberList            
     * @return SingleValueToken[]
     */
    public function create(array $numberList): array
    {
        return array_map(function ($number) {
            return SingleValueToken::create(floatval($number));
        }, $numberList);
    }
}