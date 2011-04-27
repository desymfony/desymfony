<?php

namespace Desymfony\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UsuarioBundle:Default:index.html.twig');
    }
}
