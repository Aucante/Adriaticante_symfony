<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PropertyFunctionalTest extends WebTestCase
{
    public function testShouldDisplayProperty()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real-estate');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testShouldDisplayOneProperty()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real-estate');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        //$this->assertSelectorTextContains('h2', 'TESTPROPERTY1');
    }
}
