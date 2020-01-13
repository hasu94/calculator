<?php
namespace Hasu94\Calculator\Parser;

class MathSignExploder
{

    public function extractTermsByTwoOperations(string $string, string $directOperation, string $reverseOperation)
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
}