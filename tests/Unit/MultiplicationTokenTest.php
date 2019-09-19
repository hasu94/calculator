<?php
namespace Hasu94\Calculator\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Token\MultiplicationToken;
use Hasu94\Calculator\Tests\TestConstants;

class MultiplicationTokenTest extends TestCase
{

    /**
     * @test
     */
    public function multiplication()
    {
        $leftSide = SingleValueToken::create(1.4);
        $rightSide = SingleValueToken::create(2.1);
        
        $additionResult = (new MultiplicationToken([
            SingleValueToken::create(1.4),
            SingleValueToken::create(2.1),
            SingleValueToken::create(- 10)
        ]))->evaluate();
        
        $this->assertEqualsWithDelta(- 29.4, $additionResult, TestConstants::FLOAT_PRECISION);
    }

    /**
     * @test
     */
    public function emptyTokenList()
    {
        $multiplicationResult = MultiplicationToken::create([]);
        
        $this->assertEqualsWithDelta(1, $multiplicationResult, TestConstants::FLOAT_PRECISION);
    }
}