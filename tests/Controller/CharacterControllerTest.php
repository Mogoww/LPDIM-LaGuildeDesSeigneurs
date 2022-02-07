<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CharacterControllerTest extends WebTestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }


    /**
     * Tests redirect index
     */

    public function testRedirectIndex()
    {
        $this->client->request('GET', '/character');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
    /**
     * Tests index
     */

    public function testIndex()
    {
        $this->client->request('GET', '/character/index');
        $this->assertJsonResponse();
    }

    /**
     * Tests display
     */

    public function testDisplay()
    {
        $this->client->request('GET', '/character/display/bbc451fc6e23c6a53180581d422cbf7975086c49');

        $this->assertJsonResponse($this->client->getResponse());
    }

    /**
     * Tests create
     */

    public function testCreate()
    {
        $this->client->request('POST', '/character/create');

        $this->assertJsonResponse();
    }

    /**
     * Tests inexisting identifier
     */

    public function testInexistingIdentifier()
    {
        $this->client->request('GET', '/character/display/bbc451fc6e23c6a53180581d422cbf7975086c49error');

        $this->assertError404($this->client->getResponse()->getStatusCode());
    }

    /*
    * Asserts that a Response is in json
    */
    public function assertJsonResponse()
    {
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertTrue($response->headers->contains('Content-type', 'application/json'), $response->headers);
    }

    /*
    * Asserts Error 404
    */
    public function assertError404()
    {
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
