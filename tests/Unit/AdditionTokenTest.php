<?php
namespace Hasu94\Calculator\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Token\AdditionToken;
use Hasu94\Calculator\Tests\TestConstants;

class AdditionTokenTest extends TestCase
{

    /**
     * @test
     */
    public function addition()
    {
        $additionResult = AdditionToken::create([
            SingleValueToken::create(1.4),
            SingleValueToken::create(4.7),
            SingleValueToken::create(0.1)
        ])->evaluate();
        
        $this->assertEqualsWithDelta(6.2, $additionResult, TestConstants::FLOAT_PRECISION);
    }

    /**
     * @test
     */
    public function emptyTokenList()
    {
        $additionResult = AdditionToken::create([]);
        
        $this->assertEqualsWithDelta(0, $additionResult, TestConstants::FLOAT_PRECISION);
    }
}