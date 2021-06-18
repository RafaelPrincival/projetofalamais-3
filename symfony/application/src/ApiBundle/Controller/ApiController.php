<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Call;
use ApiBundle\Entity\CityCode;
use ApiBundle\Entity\Plan;
use ApiBundle\Service\Normalize\CallNormalizer;
use ApiBundle\Service\Strategy\PlanRateCalculation;
use ApiBundle\Service\Strategy\RateCalculation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class ApiController
 * @Route("/")
 *
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Controller
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/calculate/{origin}/{destination}/{plan}/{time}", name="api_calculate")
     * @Method("POST")
     * @param CityCode $origin
     * @param CityCode $destination
     * @param Plan $plan
     * @param int $time
     * @return JsonResponse
     */
    public function calculateAction(CityCode $origin, CityCode $destination, Plan $plan, int $time) : JsonResponse
    {
        try {

            /** @var CallNormalizer $callNormalizer */
            $callNormalizer = $this->get('api.call_normalizer');
            $call = $this->getCallRepository()->findByOriginAndDestination($origin, $destination);

            if (!$call) {
                $call = new Call();
                $call
                    ->setOrigin($origin)
                    ->setDestination($destination)
                    ->setPlan($plan)
                    ->setTime($time)
                    ->setRateCost(null)
                    ->setRate(null);

                return $this->createResponse($callNormalizer->normalize($call), Response::HTTP_OK);
            }

            /** @var RateCalculation $planRateCalculationService */
            $rateCalculation = $this->get('api.rate_calculation');
            /** @var PlanRateCalculation $planRateCalculationService */
            $planRateCalculation = $this->get('api.plan_rate_calculation');

            $call
                ->setPlan($plan)
                ->setTime($time);

            $call = $rateCalculation
                ->setCall($call)
                ->calculate();

            $call = $planRateCalculation
                ->setCall($call)
                ->calculate();

            return $this->createResponse($callNormalizer->normalize($call), Response::HTTP_OK);

        } catch (\Exception $ex) {
            return $this->createResponse($ex, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}