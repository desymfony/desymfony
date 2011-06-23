<?php

/*
 * El desarrollo de esta extensión ha sido gracias al tutorial en
 * http://www.martinsikora.com/how-to-make-twig-extension-for-symfony2
 */

namespace Desymfony\DesymfonyBundle\Extension;

class DesymfonyTwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            'auto_link_text' => new \Twig_Filter_Method($this, 'auto_link_text', array('is_safe' => array('html'))),
            'format_metadesc' => new \Twig_Filter_Method($this, 'format_metadesc', array('is_safe' => array('html'))),
        );
    }

    public function getName()
    {
        return "desymfony_twig_extension";
    }

    static public function auto_link_text($string)
    {

        $regexp = "/(<a.*?>)?(https?)?(:\/\/)?(\w+\.)?(\w+)\.(\w+)(<\/a.*?>)?/i";
        $anchorMarkup = "<a href=\"%s://%s\" target=\"_blank\" >%s</a>";

        preg_match_all($regexp, $string, $matches, \PREG_SET_ORDER);

        foreach ($matches as $match) {

            // En este caso no está rodeado por una etiqueta anchor
            if (empty($match[1]) && empty($match[7])) {

                $http = $match[2]?$match[2]:'http';

                $replace = sprintf($anchorMarkup, $http, $match[0], $match[0]);

                $string = str_replace($match[0], $replace, $string);
            }

        }

        return $string;
    }

    static public function format_metadesc($string)
    {

        $string = preg_replace('/\s+/', ' ', $string);
        $string = preg_replace('/\s,/', ',', $string);
        $string = preg_replace('/\s\./', '.', $string);
        $string = trim($string);

        return $string;
    }
}


