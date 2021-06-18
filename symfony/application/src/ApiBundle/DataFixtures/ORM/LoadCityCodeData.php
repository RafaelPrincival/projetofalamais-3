<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 29/09/18
 * Time: 11:05
 */

namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\Entity\CityCode;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCityCodeData
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\DataFixtures\ORM
 */
class LoadCityCodeData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var array $cityCodeData */
    private $cityCodeData = ['011', '016', '017', '018'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->cityCodeData as $cityCodeDatum) {
            $cityCode = new CityCode();
            $cityCode->setCode($cityCodeDatum);

            $manager->persist($cityCode);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

}