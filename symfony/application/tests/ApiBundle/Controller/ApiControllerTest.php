<?php

namespace Tests\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiControllerTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Controller\ApiController
 * @package ApiBundle\Tests\Controller
 */
class ApiControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    private $testCases = [
        ['origin' => 1, 'destination' => 2, 'plan' => 1, 'time' => 20, 'planRateCost'=> 0, 'rateCost' => 38],
        ['origin' => 1, 'destination' => 3, 'plan' => 2, 'time' => 80, 'planRateCost'=> 37.40, 'rateCost' => 136],
        ['origin' => 4, 'destination' => 1, 'plan' => 3, 'time' => 200, 'planRateCost'=> 167.20, 'rateCost' => 380],
        ['origin' => 4, 'destination' => 3, 'plan' => 1, 'time' => 100, 'planRateCost'=> null, 'rateCost' => null],
    ];

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::calculateAction()
     */
    public function testCalculate()
    {
        foreach ($this->testCases as $testCase) {

            $this->client->request('POST',
                sprintf(
                    '/api/calculate/%s/%s/%s/%s',
                    $testCase['origin'],
                    $testCase['destination'],
                    $testCase['plan'],
                    $testCase['time']
                )
            );

            $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

            $data = json_decode($this->client->getResponse()->getContent(), true);

            $this->assertEquals($testCase['rateCost'], $data['rateCost']);
            $this->assertEquals($testCase['planRateCost'], $data['planRateCost']);

            $this->assertArrayHasKey('id', $data);
            $this->assertArrayHasKey('origin', $data);
            $this->assertArrayHasKey('destination', $data);
            $this->assertArrayHasKey('rate', $data);
            $this->assertArrayHasKey('time', $data);
            $this->assertArrayHasKey('rateCost', $data);
            $this->assertArrayHasKey('planRateCost', $data);
            $this->assertArrayHasKey('id', $data['plan']);
            $this->assertArrayHasKey('name', $data['plan']);
            $this->assertArrayHasKey('time', $data['plan']);
        }
    }
}