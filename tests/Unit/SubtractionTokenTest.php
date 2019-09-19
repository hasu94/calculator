<?php
namespace Hasu94\Calculator\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Token\SubtractionToken;
use Hasu94\Calculator\Tests\TestConstants;
use Hasu94\Calculator\Exception\InvalidTokenArrayException;

class SubtractionTokenTest extends TestCase
{

    /**
     * @test
     */
    public function subtraction()
    {
        $leftSide = SingleValueToken::create(2.3);
        $rightSide = SingleValueToken::create(1.4);
        
        $subtractionResult = (SubtractionToken::create([
            SingleValueToken::create(2.3),
            SingleValueToken::create(1.4),
            SingleValueToken::create(1)
        ]))->evaluate();
        
        $this->assertEqualsWithDelta(- 0.1, $subtractionResult, TestConstants::FLOAT_PRECISION);
    }

    /**
     * @test
     */
    public function invalidTokenCount()
    {
        $this->expectException(InvalidTokenArrayException::class);
        $this->expectExceptionMessage(sprintf("There should be 2 or more arguments to create a %s", SubtractionToken::class));
        
        $subtractionToken = SubtractionToken::create([
            SingleValueToken::create(4)
        ]);
    }
}