<?php
namespace Hasu94\Calculator\Token;

class MultiplicationToken extends AbstractBinaryToken
{

    public static function create(array $tokens): AbstractBinaryToken
    {
        if (count($tokens) === 1) {
            return new static($tokens);
        }
        
        return parent::create($tokens);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Hasu94\Calculator\Token\AbstractBinaryToken::doEvaluate()
     */
    protected function doEvaluate(array $tokens): float
    {
        $product = 1;
        
        foreach ($tokens as $multiplier) {
            $product *= $multiplier->evaluate();
        }
        
        return $product;
    }
}