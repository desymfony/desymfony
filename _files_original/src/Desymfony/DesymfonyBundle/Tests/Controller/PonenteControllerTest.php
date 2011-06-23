<?php
namespace Desymfony\DesymfonyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PonenteControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/ponentes');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en ponentes");
    }
}
