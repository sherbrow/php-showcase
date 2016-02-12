<?php

namespace ShowcaseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormControllerTest extends WebTestCase
{
    public function testRaw()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/form/raw');
    }

    public function testRawsubmit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/rawSubmit');
    }

}
