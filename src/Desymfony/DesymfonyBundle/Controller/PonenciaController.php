<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PonenciaController extends Controller
{
    public function indexAction()
    {
        return $this->render('DesymfonyBundle:Ponencia:index.html.twig');
    }
}
