<?php
namespace Hasu94\Calculator\Token;

use Hasu94\Calculator\Exception\InvalidTokenArrayException;

abstract class AbstractBinaryToken implements TokenInterface
{

    protected const MIN_TOKENS_COUNT = 2;

    /**
     *
     * @var TokenInterface[]
     */
    private $tokens;

    /**
     *
     * @param TokenInterface[] $tokens            
     */
    protected function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    public static function create(array $tokens): AbstractBinaryToken
    {
        if (count($tokens) < static::MIN_TOKENS_COUNT) {
            throw new InvalidTokenArrayException(sprintf('There should be %d or more arguments to create a %s', static::MIN_TOKENS_COUNT, static::class));
        }
        
        return new static($tokens);
    }

    /**
     *
     * @param TokenInterface[] $tokens            
     * @return float
     */
    abstract protected function doEvaluate(array $tokens): float;

    /**
     *
     * @return float
     */
    public function evaluate(): float
    {
        return $this->doEvaluate($this->tokens);
    }
}