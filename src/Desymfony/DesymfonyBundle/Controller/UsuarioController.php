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
        $registroUsuario = new RegistroUsuarioType($usuario);

        $usuarioForm = $this->get('form.factory')->create($registroUsuario);
        
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

//      $form = $this->get('form.factory')->create(new UsuarioType(), array());
//
//        $request = $this->get('request');
//        if ($request->getMethod() == 'POST') {
//            $form->bindRequest($request);
//
//            if ($form->isValid()) {
//
//                // Mensaje para notificar al usuario que todo ha salido bien
//                $session = $this->get('request')->getSession();
//                $session->setFlash('notice', 'Gracias por registrarte en Desymfony 2011');
//
//                // Obtenemos el usuario
//                $usuario = $form->getData();
//
//                // Codificamos el password
//                $factory = $this->get('security.encoder_factory');
//                $codificador = $factory->getEncoder($usuario);
//                $password = $codificador->encodePassword($usuario->getPassword(), $usuario->getSalt());
//                $usuario->setPassword($password);
//
//                // Guardamos el objeto en base de datos
//                $em = $this->get('doctrine')->getEntityManager();
//                $em->persist($usuario);
//                $em->flush();
//
//                // Logueamos al usuario
//                $token = new UsernamePasswordToken($usuario, null, 'main', $usuario->getRoles());
//                $this->get('security.context')->setToken($token);
//
//                return $this->redirect($this->generateUrl('portada'));
//            }
//        }
//        return $this->render('DesymfonyBundle:Usuario:registro.html.twig', array('form' => $form->createView()));
    }

    public function denegadoAction()
    {
        return $this->render('DesymfonyBundle:Usuario:denegado.html.twig');
    }
}
