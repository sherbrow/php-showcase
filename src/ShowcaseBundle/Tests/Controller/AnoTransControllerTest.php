<?php

namespace ShowcaseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnoTransControllerTest extends WebTestCase
{
    public function testWelcome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/welcome');
    }

}
