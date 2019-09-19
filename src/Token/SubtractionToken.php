<?php
namespace Hasu94\Calculator\Token;

class SubtractionToken extends AbstractBinaryToken
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Hasu94\Calculator\Token\AbstractBinaryToken::doEvaluate()
     */
    public function doEvaluate(array $tokens): float
    {
        $minuend = array_shift($tokens)->evaluate();
        
        foreach ($tokens as $subtrahend) {
            $minuend -= $subtrahend->evaluate();
        }
        
        return $minuend;
    }
}