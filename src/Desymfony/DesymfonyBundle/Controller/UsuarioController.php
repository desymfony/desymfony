<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Desymfony\DesymfonyBundle\Entity\Usuario;
use Desymfony\DesymfonyBundle\Form\Type\RegistroUsuarioType;
use Desymfony\DesymfonyBundle\Form\Handler\RegistroUsuarioHandler;

class UsuarioController extends Controller
{
    public function indexAction()
    {
        return $this->render('DesymfonyBundle:Usuario:index.html.twig');
    }

    public function loginAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('DesymfonyBundle:Usuario:login.html.twig', array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function perfilAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        return $this->render('DesymfonyBundle:Usuario:perfil.html.twig', array('usuario' => $usuario));
    }

    public function registroAction()
    {
        $em = $this->get('doctrine')->getEntityManager();

        
        $usuario = new Usuario();

        // Objeto del dominio del formulario de registro donde se van a volcar
        // y a validar los datos
        $registroUsuario = new RegistroUsuarioType($usuario);

        // Formulario de registro
        $usuarioForm = $this->get('form.factory')->create($registroUsuario);

        // Manejador del formulario de registro encargado de procesar los datos
        $registroFormHandler = new RegistroUsuarioHandler(
            $usuarioForm,
            $this->get('request'),
            $this->get('desymfony.usuario_manager')
        );
        
        if ($registroFormHandler->process($usuario) == true) {
            $session = $this->get('request')->getSession();
            $session->setFlash('notice', 'Gracias por registrarte en Desymfony 2011');

            // Logueamos al usuario
            $token = new UsernamePasswordToken($usuario, null, 'main', $usuario->getRoles());
            $this->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('portada'));
        }

        return $this->render('DesymfonyBundle:Usuario:registro.html.twig', array(
            'form' => $usuarioForm->createView())
        );
    }

    public function denegadoAction()
    {
        return $this->render('DesymfonyBundle:Usuario:denegado.html.twig');
    }
}
