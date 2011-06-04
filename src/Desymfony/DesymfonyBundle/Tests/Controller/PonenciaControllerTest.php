<?php
namespace Desymfony\DesymfonyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PonenciaControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/ponencias');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en ponencias");
        $this->assertTrue($crawler->filter('html:contains("Ponencias")')->count()> 0, "La vista contiene la palabra Ponencias");
    }

    public function testPonencia()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/ponencia/el-modelo-doctrine2');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en vista ponencia");

        $crawler = $client->request('GET', '/ponencia/noexisto');
        $this->assertEquals(404, $client->getResponse()->getStatusCode(), "Status 404 para /ponencia y slug inválida");

    }

    public function testApuntarse()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/me-apunto-a-el-modelo-doctrine2');
        $this->assertEquals(302, $client->getResponse()->getStatusCode(), 'El usuario no registrado es redirigido al login');
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}

