<?php

/* 
 * El desarrollo de esta extensión ha sido gracias al tutorial en
 * http://www.martinsikora.com/how-to-make-twig-extension-for-symfony2
 */

namespace Desymfony\DesymfonyBundle\Extension;

class DesymfonyTwigExtension extends \Twig_Extension{

    public function getFilters(){
        return array(
            'resumen' => new \Twig_Filter_Method($this, 'resumen')
        );
    }

    public function resumen($string, $length = 100){
        $matches = array();
        preg_match("/^(.{1,$length})[\s]/i", $string, $matches);
        return $matches[1]." ...";
    }

    public function getName(){
        return "desymfony_twig_extension";
    }

}
