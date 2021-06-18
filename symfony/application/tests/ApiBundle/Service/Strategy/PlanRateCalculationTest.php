<?php

namespace Tests\ApiBundle\Service\Strategy;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\Plan;
use ApiBundle\Service\Strategy\PlanRateCalculation;

/**
 * Class PlanRateCalculationTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Service\Strategy\PlanRateCalculation
 * @package ApiBundle\Tests\Service\Strategy
 */
class PlanRateCalculationTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PlanRateCalculation */
    private $planRateCalculation;


    public function setUp()
    {
        $this->planRateCalculation = new PlanRateCalculation();
    }

    /**
     * @covers \ApiBundle\Service\Strategy\PlanRateCalculation::setCall
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

        $planRateCalculation = $this->planRateCalculation->setCall($call);

        $this->assertInstanceOf("\ApiBundle\Service\Strategy\PlanRateCalculation", $planRateCalculation);

        return $call;
    }

    /**
     * @covers \ApiBundle\Service\Strategy\PlanRateCalculation::calculate
     * @param Call $call
     * @depends testSetCall
     */
    public function testCalculate($call)
    {
        $call = $this
            ->planRateCalculation
            ->setCall($call)
            ->calculate();

        $this->assertInstanceOf("\ApiBundle\Entity\Call", $call);
        $this->assertEquals(194.37, $call->getPlanRateCost());
    }
}