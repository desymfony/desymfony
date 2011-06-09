<?php
namespace Desymfony\DesymfonyBundle\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en portada");

    }

    public function testEstatica()
    {
        $client = $this->createClient();
        $client->request('GET', '/sitio/condiciones');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en estática condiciones");
        $client->request('GET', '/sitio/contacto');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en estática contacto");
        $client->request('GET', '/sitio/copyright');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en estática copyright");
        $client->request('GET', '/sitio/privacidad');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status 200 en estática privacidad");
    }
}
