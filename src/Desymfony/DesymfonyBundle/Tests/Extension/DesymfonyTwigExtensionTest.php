<?php
namespace Desymfony\DesymfonyBundle\Tests\Extension;

use Desymfony\DesymfonyBundle\Extension\DesymfonyTwigExtension;

class DesymfonyTwigExtensionTest extends \PHPUnit_Framework_TestCase{

    public function testURLesConvertidaAEnlace()
    {
        $texto          = 'www.google.es';
        $texto_esperado = '<a href="http://www.google.es" target="_blank" >www.google.es</a>';
        $texto_filtrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals( $texto_esperado, $texto_filtrado);
    }

    public function testAnchorsNoPasanPorElFiltro()
    {
        $texto          = '<a href="http://www.google.es" target="_blank" >www.yahoo.es</a>';
        $texto_esperado = '<a href="http://www.google.es" target="_blank" >www.yahoo.es</a>';
        $texto_filtrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals( $texto_esperado, $texto_filtrado);
    }

    public function testURLenParrafoEsConvertida()
    {
        $texto          = <<<HTML
        <p>Lorem ipsum dolor et sit www.google.es con amet</p>
HTML;

        $texto_esperado = <<<HTML
        <p>Lorem ipsum dolor et sit <a href="http://www.google.es" target="_blank" >www.google.es</a> con amet</p>
HTML;

        $texto_filtrado = DesymfonyTwigExtension::auto_link_text($texto);

        $this->assertEquals( $texto_esperado, $texto_filtrado);

    }

}
