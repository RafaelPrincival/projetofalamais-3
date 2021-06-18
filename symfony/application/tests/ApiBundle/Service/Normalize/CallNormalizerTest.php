<?php

namespace Tests\ApiBundle\Service\Normalize;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\CityCode;
use ApiBundle\Entity\Plan;
use ApiBundle\Service\Normalize\CallNormalizer;

/**
 * Class CallNormalizerTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Service\Normalize\CallNormalizer
 * @package ApiBundle\Tests\Service\Normalize
 */
class CallNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CallNormalizer */
    private $callNormalizer;


    public function setUp()
    {
        $this->callNormalizer = new CallNormalizer();
    }

    /**
     * @covers \ApiBundle\Service\Normalize\CallNormalizer::normalize()
     */
    public function testNormalize()
    {
        $call = new Call();
        $call
            ->setOrigin(new CityCode())
            ->setDestination(new CityCode())
            ->setRate(1.9)
            ->setTime(123);

        $plan = new Plan();
        $plan
            ->setTime(30)
            ->setName('FaleMais 30');

        $call->setPlan($plan);

        $normalizedCall = $this->callNormalizer->normalize($call);

        $this->assertArrayHasKey('id', $normalizedCall);
        $this->assertArrayHasKey('origin', $normalizedCall);
        $this->assertArrayHasKey('destination', $normalizedCall);
        $this->assertArrayHasKey('rate', $normalizedCall);
        $this->assertArrayHasKey('time', $normalizedCall);
        $this->assertArrayHasKey('rateCost', $normalizedCall);
        $this->assertArrayHasKey('planRateCost', $normalizedCall);
        $this->assertArrayHasKey('id', $normalizedCall['plan']);
        $this->assertArrayHasKey('name', $normalizedCall['plan']);
        $this->assertArrayHasKey('time', $normalizedCall['plan']);
    }
}