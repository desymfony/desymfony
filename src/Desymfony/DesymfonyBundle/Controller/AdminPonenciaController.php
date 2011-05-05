<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminPonenciaController extends Controller
{
    public function listAction()
    {
        return $this->render('DesymfonyBundle:AdminPonencia:index.html.twig');
    }
}
