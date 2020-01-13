<?php
namespace Hasu94\Calculator\Token;

class AdditionToken extends AbstractBinaryToken
{

    public static function create(array $tokens): AbstractBinaryToken
    {
        if (count($tokens) < static::MIN_TOKENS_COUNT) {
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
        $sum = 0;
        
        foreach ($tokens as $token) {
            $sum += $token->evaluate();
        }
        
        return $sum;
    }
}