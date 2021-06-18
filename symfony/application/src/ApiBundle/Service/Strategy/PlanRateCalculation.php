<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 28/09/18
 * Time: 09:43
 */

namespace ApiBundle\Service\Strategy;

use ApiBundle\Entity\Call;

/**
 * Class PlanRateCalculation
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Service\Strategy
 */
class PlanRateCalculation implements RateCalculationInterface
{
    /** @var Call $call */
    private $call;

    const CALL_RATE_PERCENTAGE = 0.10;

    /**
     * @return Call
     */
    public function calculate() : Call
    {
        $this->call->setPlanRateCost(0);

        $diffCallTimeAndPlanRateTime = $this->call->getTime() - $this->call->getPlan()->getTime();

        if ($diffCallTimeAndPlanRateTime > 0) {
            $additionalCallRatePercentage = $this->call->getRate() * self::CALL_RATE_PERCENTAGE;
            $planRateCost = $diffCallTimeAndPlanRateTime * ($this->call->getRate() + $additionalCallRatePercentage);

            $this->call->setPlanRateCost(bcdiv($planRateCost, 1, 2));
        }

        return $this->call;
    }

    /**
     * @param Call $call
     * @return $this
     */
    public function setCall(Call $call) : PlanRateCalculation
    {
        $this->call = $call;

        return $this;
    }
}