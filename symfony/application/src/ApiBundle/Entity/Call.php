<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Call
 *
 * @ORM\Table(name="calls")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CallRepository")
 */
class Call
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="origin", type="string")
     */

    /**
     * @var CityCode
     * Many Calls have One Origin
     *
     * @ORM\ManyToOne(targetEntity="CityCode", inversedBy="calls")
     * @ORM\JoinColumn(name="origin_id", referencedColumnName="id")
     */
    private $origin;

    /**
     * @var CityCode
     * Many Calls have One Destination
     *
     * @ORM\ManyToOne(targetEntity="CityCode", inversedBy="calls")
     * @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     */
    private $destination;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @var int
     *
     */
    private $time;

    /**
     * @var float
     *
     */
    private $rateCost;

    /**
     * @var float
     *
     */
    private $planRateCost;

    /**
     * @var Plan
     *
     */
    private $plan;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set origin
     *
     * @param CityCode $origin
     *
     * @return Call
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return int
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set destination
     *
     * @param CityCode $destination
     *
     * @return Call
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return int
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return Call
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set time
     *
     * @param int $time
     *
     * @return Call
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set rateCost
     *
     * @param float $rateCost
     *
     * @return Call
     */
    public function setRateCost($rateCost)
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRateCost()
    {
        return $this->rateCost;
    }

    /**
     * Set planRateCost
     *
     * @param float $planRateCost
     *
     * @return Call
     */
    public function setPlanRateCost($planRateCost)
    {
        $this->planRateCost = $planRateCost;

        return $this;
    }

    /**
     * Get planRateCost
     *
     * @return float
     */
    public function getPlanRateCost()
    {
        return $this->planRateCost;
    }

    /**
     * Set plan
     *
     * @param Plan $plan
     *
     * @return Call
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }
}

