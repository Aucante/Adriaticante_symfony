<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AboutFunctionalTest extends WebTestCase
{
    public function testShouldDisplayAbout(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'ABOUT US');
        $this->assertSelectorTextContains('h2', 'OUR HERITAGE');
    }
}
