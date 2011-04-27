<?php

namespace Desymfony\ComunBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ComunBundle:Default:index.html.twig');
    }
}
