<?php

namespace Desymfony\PonenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PonenteBundle:Default:index.html.twig');
    }
}
