<?php
namespace Hasu94\Calculator\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Token\DivisionToken;
use Hasu94\Calculator\Tests\TestConstants;

class DivisionTokenTest extends TestCase
{

    /**
     * @test
     */
    public function division()
    {
        $leftSide = SingleValueToken::create(8.82);
        $rightSide = SingleValueToken::create(1.4);
        
        $additionResult = (new DivisionToken([
            SingleValueToken::create(8.82),
            SingleValueToken::create(1.4),
            SingleValueToken::create(63)
        ]))->evaluate();
        
        $this->assertEqualsWithDelta(0.1, $additionResult, TestConstants::FLOAT_PRECISION);
    }

    /**
     * @test
     */
    public function invalidTokenCount()
    {
        $this->expectException(InvalidTokenArrayException::class);
        $this->expectExceptionMessage(sprintf("There should be 2 or more arguments to create a %s", DivisionToken::class));
        
        $divisionToken = DivisionToken::create([
            SingleValueToken::create(4)
        ]);
    }
}