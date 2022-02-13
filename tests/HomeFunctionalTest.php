<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeFunctionalTest extends WebTestCase
{
    public function testShouldDisplayHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');


        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'DISCOVER');
        $this->assertSelectorTextContains('h2', 'EXPLORER');
        $this->assertSelectorTextContains('h3', 'LAST PROPERTIES');
        $this->assertSelectorTextContains('', 'CROATIA');
        $this->assertSelectorTextContains('', 'SLOVENIA');
        $this->assertSelectorTextContains('', 'ITALY');
        $this->assertSelectorTextContains('', 'MONTENEGRO');
    }
}
