<?php

namespace ApiBundle\Repository;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\CityCode;
use Doctrine\ORM\EntityRepository;

/**
 * Class CallRepository
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Repository
 */
class CallRepository extends EntityRepository
{
    /**
     * @param CityCode $origin
     * @param CityCode $destination
     * @return null|object
     */
    public function findByOriginAndDestination(CityCode $origin, CityCode $destination)
    {
        return $this
                ->getEntityManager()
                ->getRepository(Call::class)
                ->findOneBy(['origin' => $origin, 'destination' => $destination]);
    }
}