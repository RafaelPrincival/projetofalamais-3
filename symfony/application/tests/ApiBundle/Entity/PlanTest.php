<?php
namespace Tests\ApiBundle\Entity;

use ApiBundle\Entity\Plan;

/**
 * Class PlanTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Entity\Plan
 * @package ApiBundle\Tests\Entity
 */
class PlanTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Plan
     */
    protected $plan;

    protected function setUp()
    {
        $this->plan = new Plan();
    }

    public function testGetterAndSetter()
    {
        $this->assertNull($this->plan->getId());

        $this->plan->setTime(32);
        $this->assertEquals(32, $this->plan->getTime());

        $this->plan->setName('FaleMais 30');
        $this->assertEquals('FaleMais 30', $this->plan->getName());
    }
}
