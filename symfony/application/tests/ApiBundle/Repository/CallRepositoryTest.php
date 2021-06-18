<?php

namespace Tests\ApiBundle\Repository;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\CityCode;
use ApiBundle\Repository\CallRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CityCodeRepositoryTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Repository\CallRepository
 * @package ApiBundle\Tests\Repository
 */
class CallRepositoryTest extends WebTestCase
{
    /** @var  CallRepository */
    private $callRepository;

    /** @var EntityManager */
    private $entityManager;


    public function setUp()
    {
        static::bootKernel();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');

        $this->callRepository = $this->entityManager->getRepository(Call::class);
    }

    /**
     * @covers \ApiBundle\Repository\CallRepository::findByOriginAndDestination()
     */
    public function testFindByOriginAndDestination()
    {
        /** @var CityCode $origin */
        $origin = $this->entityManager->getRepository(CityCode::class)->find(1);
        /** @var CityCode $destination */
        $destination = $this->entityManager->getRepository(CityCode::class)->find(3);

        $call = $this->callRepository->findByOriginAndDestination($origin, $destination);

        $this->assertInstanceOf(Call::class, $call);
    }
}