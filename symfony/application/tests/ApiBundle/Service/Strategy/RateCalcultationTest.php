<?php

namespace Tests\ApiBundle\Service\Strategy;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\Plan;
use ApiBundle\Service\Strategy\RateCalculation;

/**
 * Class RateCalcultationTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Service\Strategy\RateCalculation
 * @package ApiBundle\Tests\Strategy
 */
class RateCalculationTest extends \PHPUnit_Framework_TestCase
{
    /** @var  RateCalculation */
    private $rateCalculation;


    public function setUp()
    {
        $this->rateCalculation = new RateCalculation();
    }

    /**
     * @covers \ApiBundle\Service\Strategy\RateCalculation::setCall
     * @return Call $call
     */
    public function testSetCall()
    {
        $call = new Call();
        $call
            ->setOrigin('011')
            ->setDestination('016')
            ->setRate(1.9)
            ->setTime(123);

        $plan = new Plan();
        $plan
            ->setTime(30)
            ->setName('FaleMais 30');

        $call->setPlan($plan);

        $rateCalculation = $this->rateCalculation->setCall($call);

        $this->assertInstanceOf("\ApiBundle\Service\Strategy\RateCalculation", $rateCalculation);

        return $call;
    }

    /**
     * @covers \ApiBundle\Service\Strategy\RateCalculation::calculate
     * @param Call $call
     * @depends testSetCall
     */
    public function testCalculate($call)
    {
        $call = $this
            ->rateCalculation
            ->setCall($call)
            ->calculate();

        $this->assertInstanceOf("\ApiBundle\Entity\Call", $call);
        $this->assertEquals(233.70, $call->getRateCost());
    }
}