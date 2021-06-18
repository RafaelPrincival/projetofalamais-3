<?php

namespace AppBundle\Controller;

use ApiBundle\Entity\CityCode;
use ApiBundle\Entity\Plan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AppController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $plans = $this->getDoctrine()->getRepository(Plan::class)->findAll();
        $codes = $this->getDoctrine()->getRepository(CityCode::class)->findAll();

        return ['plans' => $plans, 'codes' => $codes];
    }
}
