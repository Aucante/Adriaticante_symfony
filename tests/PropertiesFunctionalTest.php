<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PropertiesFunctionalTest extends WebTestCase
{
    public function testShouldDisplayProperties(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/properties');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'REAL ESTATE');
    }

    public function testShouldDisplayOneProperties(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/properties/testproperty');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'TESTPROPERTY');
        $this->assertSelectorTextContains('', 'Price');
        $this->assertSelectorTextContains('', 'Area');
        $this->assertSelectorTextContains('', 'Price/Area');
    }

}
