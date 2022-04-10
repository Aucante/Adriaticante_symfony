<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactFunctionalTest extends WebTestCase
{
    public function testShouldDisplayContact(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
