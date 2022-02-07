<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CharacterControllerTest extends WebTestCase
{
    /**
     * Tests index
     */

    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/character');

        $response = $client->getResponse();
        // $this->assertEquals(200,$response->getStatusCode());
        $this->assertResponseIsSuccessful();
    }

    /**
     * Tests display
     */

    public function testDisplay()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/character/display');

        $this->assertJsonResponse($client->getResponse());
    }

    /**
     * Tests create
     */

    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/character/create');

        $this->assertJsonResponse($client->getResponse());
    }

    /*
    * Asserts that a Response is in json
    */
    public function assertJsonResponse($response)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-type', 'application/json'), $response->headers);
    }
}
