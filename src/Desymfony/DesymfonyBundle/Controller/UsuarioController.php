<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UsuarioController extends Controller
{
    public function registroAction()
    {
        return $this->render('DesymfonyBundle:Usuario:registro.html.twig');
    }
}
