<?php

namespace Desymfony\PonenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PonenciaBundle:Default:index.html.twig');
    }
}
