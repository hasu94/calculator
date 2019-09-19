<?php
namespace Hasu94\Calculator\Parser;

use Hasu94\Calculator\Token\TokenInterface;
use Hasu94\Calculator\Token\MultiplicationToken;
use Hasu94\Calculator\Token\Factory\SingleValueTokenArrayFactory;
use Hasu94\Calculator\Token\DivisionToken;
use Hasu94\Calculator\Token\AdditionToken;
use Hasu94\Calculator\Token\SubtractionToken;
use Hasu94\Calculator\Token\SingleValueToken;

class SimpleMathStringParser
{

    /**
     *
     * @var SingleValueTokenArrayFactory
     */
    private $singleValueTokenArrayFactory;

    public function __construct(
        SingleValueTokenArrayFactory $singleValueTokenArrayFactory)
    {
        $this->singleValueTokenArrayFactory = $singleValueTokenArrayFactory;
    }

    public function parse(string $string): TokenInterface
    {
        $cleanedFromSpaces = str_replace(' ', $string);
        
        list ($addendList, $subtrahendList) = $this->extractAddendSubtrahendList(
            $cleanedFromSpaces);
        
        $addendTokenList = $this->parseAddendList($addendList);
        
        if (empty($subtrahendList)) {
            $subtrahendTokenList = $this->parseAddendList($subtrahendList);
            
            return AdditionToken::create($addendTokenList);
        }
        
        return SubtractionToken::create(
            [
                AdditionToken::create($addendTokenList),
                AdditionToken::create($subtrahendTokenList)
            ]);
    }

    private function extractAddendSubtrahendList(string $string)
    {
        // /* $addendList = explode('+', $string);
        // $subtrahendList = [];
        
        // foreach ($addendList as &$addend) {
        // $explodedBySubtraction = explode('-', $addend);
        // $addend = array_shift($explodedBySubtraction);
        // $subtrahendList = array_merge($subtrahendList,
        // $explodedBySubtraction);
        // }
        
        // return [$addendList, $subtrahendList]; */
        return $this->extractTermsByTwoOperations('+', '-');
    }

    private function extractTermsByTwoOperations(string $directOperation, 
        string $reverseOperation)
    {
        $directOperationTermList = explode($directOperation, $string);
        $reverseOperationTermList = [];
        
        foreach ($directOperationTermList as &$directOperationTerm) {
            $explodedByReverseOperation = explode($reverseOperation, 
                $directOperationTerm);
            $directOperationTerm = array_shift($explodedByReverseOperation);
            $reverseOperationTermList = array_merge($reverseOperationTermList, 
                $explodedByReverseOperation);
        }
        
        return [
            $directOperationTermList,
            $reverseOperationTermList
        ];
    }

    private function parseAddendList(array $addendList)
    {
        $addendTokenList = [];
        
        foreach ($addendList as $addend) {
            $addendTokenList[] = $this->parseSingleAddend($addend);
        }
        
        return $addendTokenList;
    }

    private function parseSingleAddend(string $addend): TokenInterface
    {
        /* if (strpos($addend, '*') !== false || strpos($addend, '/') !== false) {
            return $this->parseMultiplication($addend);
        }
        
        return SingleValueToken::create(floatvar($addend)); */
        
        return $this->parseMultiplication($addend);
    }

    private function parseMultiplication(string $multiplicationExpr): TokenInterface
    {
        list ($multiplierList, $divisorList) = $this->extractTermsByTwoOperations(
            '*', '/');
        
        $multiplicationPartToken = MultiplicationToken::create(
            $this->singleValueTokenArrayFactory->create($multiplierList));
        if (empty($divisorList)) {
            return $multiplicationPartToken;
        }
        $divisionPartToken = $this->singleValueTokenArrayFactory->create(
            $divisorList);
        
        return DivisionToken::create(
            array_merge([
                $multiplicationPartToken
            ], $divisionPartToken));
    }
}