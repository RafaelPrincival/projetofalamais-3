<?php
namespace Tests\ApiBundle\Entity;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\CityCode;
use ApiBundle\Entity\Plan;

/**
 * Class CityCodeTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Entity\CityCode
 * @package ApiBundle\Tests\Entity
 */
class CityCodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CityCode
     */
    protected $cityCode;

    protected function setUp()
    {
        $this->cityCode = new CityCode();
    }

    public function testGetterAndSetter()
    {
        $this->assertNull($this->cityCode->getId());

        $this->cityCode->setCode('017');
        $this->assertEquals('017', $this->cityCode->getCode());
    }
}
