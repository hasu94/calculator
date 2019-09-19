<?php
namespace Hasu94\Calculator\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Hasu94\Calculator\Token\AdditionToken;
use Hasu94\Calculator\Token\MultiplicationToken;
use Hasu94\Calculator\Token\DivisionToken;
use Hasu94\Calculator\Tests\TestConstants;
use Hasu94\Calculator\Token\SingleValueToken;

class CalculatorTest extends KernelTestCase
{

    public function testCalculate()
    {
        $resultToken = new AdditionToken([
            new MultiplicationToken([
                new SingleValueToken(2),
                new SingleValueToken(3)
            ]),
            new DivisionToken([
                new SingleValueToken(10),
                new SingleValueToken(2)
            ])
        ]);
        
        $this->assertEqualsWithDelta(2 * 3 + 10 / 2, $resultToken->evaluate(), TestConstants::FLOAT_PRECISION);
    }
}