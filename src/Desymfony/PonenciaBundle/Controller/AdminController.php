<?php

namespace Desymfony\PonenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function listAction()
    {
        return $this->render('PonenciaBundle:Admin:index.html.twig');
    }
}
