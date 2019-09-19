<?php
namespace Hasu94\Calculator\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Hasu94\Calculator\Parser\SimpleMathStringParser;

class ServiceTest extends KernelTestCase
{
    
    public function testServices()
    {
        self::bootKernel();
        $container = self::$container;
        
        $parser = $container->get(SimpleMathStringParser::class);
        
        $this->assertTrue(true);
    }
}