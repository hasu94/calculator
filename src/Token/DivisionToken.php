<?php
namespace Hasu94\Calculator\Token;

use Hasu94\Calculator\Exception\DivisionByZeroException;

class DivisionToken extends AbstractBinaryToken
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Hasu94\Calculator\Token\AbstractBinaryToken::doEvaluate()
     */
    protected function doEvaluate(array $tokens): float
    {
        $divisor = array_shift($tokens)->evaluate();
        
        try {
            foreach ($tokens as $dividend) {
                $divisor /= $dividend->evaluate();
            }
            
            return $divisor;
        } catch (\DivisionByZeroError $e) {
            throw new DivisionByZeroException();
        }
    }
}