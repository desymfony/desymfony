<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PonenteController extends Controller
{
    public function indexAction()
    {
        return $this->render('DesymfonyBundle:Ponente:index.html.twig');
    }
}
