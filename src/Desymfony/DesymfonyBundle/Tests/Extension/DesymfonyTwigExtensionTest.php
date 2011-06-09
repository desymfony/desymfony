<?php
namespace Desymfony\DesymfonyBundle\Tests\Extension;

use Desymfony\DesymfonyBundle\Extension\DesymfonyTwigExtension;

class DesymfonyTwigExtensionTest extends \PHPUnit_Framework_TestCase
{

    public function testURLesConvertidaAEnlace()
    {
        $texto          = 'www.google.es';
        $textoEsperado = '<a href="http://www.google.es" target="_blank" >www.google.es</a>';
        $textoFiltrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals($textoEsperado, $textoFiltrado);
    }

    public function testAnchorsNoPasanPorElFiltro()
    {
        $texto          = '<a href="http://www.google.es" target="_blank" >www.yahoo.es</a>';
        $textoEsperado = '<a href="http://www.google.es" target="_blank" >www.yahoo.es</a>';
        $textoFiltrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals($textoEsperado, $textoFiltrado);
    }

    public function testURLenParrafoEsConvertida()
    {
        $texto          = <<<HTML
        <p>Lorem ipsum dolor et sit www.google.es con amet</p>
HTML;

        $textoEsperado = <<<HTML
        <p>Lorem ipsum dolor et sit <a href="http://www.google.es" target="_blank" >www.google.es</a> con amet</p>
HTML;

        $textoFiltrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals($textoEsperado, $textoFiltrado);

    }

}
