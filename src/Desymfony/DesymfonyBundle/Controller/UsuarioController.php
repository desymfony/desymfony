<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Desymfony\DesymfonyBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

    public function loginCheckAction()
    {
        
    }

    public function logoffAction()
    {
        
    }

    public function perfilAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        return $this->render('DesymfonyBundle:Usuario:perfil.html.twig', array('usuario' => $usuario));
    }

    public function registroAction()
    {
        $form = $this->get('form.factory')->create(new UsuarioType(), array());
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                // Mensaje para notificar al usuario que todo ha salido bien
                $session = $this->get('request')->getSession();
                $session->setFlash('notice', 'Gracias por registrarte en Desymfony 2011');

                // Guardamos el objeto en base de datos
                $usuario = $form->getData();
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($usuario);
                $em->flush();

                // Logueamos al usuario
                $token = new UsernamePasswordToken($usuario, null, 'main', $usuario->getRoles());
                $this->get('security.context')->setToken($token);

                return $this->redirect($this->generateUrl('registro'));
            }
        }
        return $this->render('DesymfonyBundle:Usuario:registro.html.twig', array('form' => $form->createView()));
    }
}
