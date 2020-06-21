<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfessionnelControllerTest extends WebTestCase
{
    public function testSubscribe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subscribe');
    }

}
