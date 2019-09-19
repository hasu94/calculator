<?php
namespace Hasu94\Calculator\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Hasu94\Calculator\Token\SingleValueToken;
use Hasu94\Calculator\Tests\TestConstants;

class SingleValueTokenTest extends TestCase
{

    /**
     * @test
     */
    public function evaluate()
    {
        $singleValue = SingleValueToken::create(1.5);
        
        $this->assertEqualsWithDelta(1.5, $singleValue->evaluate(), TestConstants::FLOAT_PRECISION);
    }
}