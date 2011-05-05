<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsuarioController extends Controller
{
    public function indexAction()
    {
        return $this->render('DesymfonyBundle:Usuario:index.html.twig');
    }
}
