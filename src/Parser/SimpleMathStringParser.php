<?php
namespace Hasu94\Calculator\Parser;

use Hasu94\Calculator\Token\TokenInterface;
use Hasu94\Calculator\Token\AdditionToken;
use Hasu94\Calculator\Token\SubtractionToken;

class SimpleMathStringParser implements MathStringParserInterface
{
	/**
     *
     * @var AddendParser
     */
    private $addendParser;

    /**
     *
     * @var MathSignExploder
     */
    private $mathSignExploder;

    public function __construct(AddendParser $addendParser, MathSignExploder $mathSignExploder)
    {
        $this->addendParser = $addendParser;
        $this->mathSignExploder = $mathSignExploder;
    }

    public function parse(string $string): TokenInterface
    {
        $cleanedFromSpaces = str_replace(' ', '', $string);
        
        list ($addendList, $subtrahendList) = $this->mathSignExploder->extractTermsByTwoOperations($cleanedFromSpaces, '+', '-');
        
        $addendTokenList = $this->parseAddendList($addendList);
        $subtrahendTokenList = [];
        
        if (empty($subtrahendList)) {
            $addendTokenList = $this->parseAddendList($subtrahendList);
            
            return AdditionToken::create($addendTokenList);
        }
        
        $subtrahendTokenList = $this->parseAddendList($subtrahendList);
        
        return SubtractionToken::create([
            AdditionToken::create($addendTokenList),
            AdditionToken::create($subtrahendTokenList)
        ]);
    }

    private function extractTermsByTwoOperations(string $string, string $directOperation, string $reverseOperation)
    {
        $directOperationTermList = explode($directOperation, $string);
        $reverseOperationTermList = [];
        
        foreach ($directOperationTermList as &$directOperationTerm) {
            $explodedByReverseOperation = explode($reverseOperation, $directOperationTerm);
            $directOperationTerm = array_shift($explodedByReverseOperation);
            $reverseOperationTermList = array_merge($reverseOperationTermList, $explodedByReverseOperation);
        }
        
        return [
            $directOperationTermList,
            $reverseOperationTermList
        ];
    }

    /**
     *
     * @param array $addendList            
     * @return TokenInterface[]
     */
    private function parseAddendList(array $addendList): array
    {
        $addendTokenList = [];
        
        foreach ($addendList as $addend) {
            $addendTokenList[] = $this->addendParser->parseSingleAddend($addend);
        }
        
        return $addendTokenList;
    }
}