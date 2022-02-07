<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CharacterControllerTest extends WebTestCase
{
    /**
     * Tests redirect index
     */

    public function testRedirectIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/character');

        $client->getResponse();
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    /**
     * Tests index
     */

    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/character/index');
        $client->getResponse();
        $this->assertResponseIsSuccessful();
    }

    /**
     * Tests display
     */

    public function testDisplay()
    {
        $client = static::createClient();
        $client->request('GET', '/character/display/bbc451fc6e23c6a53180581d422cbf7975086c49');

        $this->assertJsonResponse($client->getResponse());
    }

    /**
     * Tests create
     */

    // public function testCreate()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('POST', '/character/create');

    //     $this->assertJsonResponse($client->getResponse());
    // }

    /*
    * Asserts that a Response is in json
    */
    public function assertJsonResponse($response)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-type', 'application/json'), $response->headers);
    }
}
