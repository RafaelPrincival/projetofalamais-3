<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AppControllerTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \AppBundle\Controller\AppController
 * @package AppBundle\Tests\Controller
 */
class AppControllerTest extends WebTestCase
{
    /**
     * @covers \AppBundle\Controller\AppController::indexAction()
     */
    public function testIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}