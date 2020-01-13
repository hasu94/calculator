<?php
namespace Hasu94\Calculator\Parser;

use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Token\MultiplicationToken;
use Hasu94\Calculator\Token\DivisionToken;
use Hasu94\Calculator\Token\TokenInterface;
use Hasu94\Calculator\Token\Factory\SingleValueTokenArrayFactory;

class AddendParser
{

    /**
     *
     * @var MathSignExploder
     */
    private $mathSignExploder;

    /**
     *
     * @var SingleValueTokenArrayFactory
     */
    private $singleValueTokenArrayFactory;

    public function __construct(MathSignExploder $mathSignExploder, SingleValueTokenArrayFactory $singleValueTokenArrayFactory)
    {
        $this->mathSignExploder = $mathSignExploder;
        $this->singleValueTokenArrayFactory = $singleValueTokenArrayFactory;
    }

    public function parseSingleAddend(string $addend): TokenInterface
    {
        if (strpos($addend, '*') !== false || strpos($addend, '/') !== false) {
            return $this->parseMultiplication($addend);
        }
        
        return SingleValueToken::create(floatval($addend));
    }

    private function parseMultiplication(string $multiplicationExpr): TokenInterface
    {
        list ($multiplierList, $divisorList) = $this->mathSignExploder->extractTermsByTwoOperations($multiplicationExpr, '*', '/');
        
        $multiplicationPartToken = MultiplicationToken::create($this->singleValueTokenArrayFactory->create($multiplierList));
        if (empty($divisorList)) {
            return $multiplicationPartToken;
        }
        $divisionPartToken = $this->singleValueTokenArrayFactory->create($divisorList);
        
        return DivisionToken::create(array_merge([
            $multiplicationPartToken
        ], $divisionPartToken));
    }
}