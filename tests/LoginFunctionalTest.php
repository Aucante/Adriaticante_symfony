<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginFunctionalTest extends WebTestCase
{
    public function testShouldDisplayLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Sign In');
    }

    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $buttonCrawlerNode = $crawler->selectButton('Sign in');

        $form = $buttonCrawlerNode->form([
            'username' => 'testusername',
            'password' => 'password'
        ]);

        $client->submit($form);

        $crawler = $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('', 'You are logged in as testusername');
    }

}
