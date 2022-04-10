<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomepageFunctionalTest extends WebTestCase
{
    public function testShouldDisplayHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
