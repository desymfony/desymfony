<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Desymfony\DesymfonyBundle\Entity\Ponencia;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PonenciaController extends Controller
{
    public function indexAction()
    {
        $em        = $this->get('doctrine.orm.entity_manager');
        $ponencias = $em->getRepository('\Desymfony\DesymfonyBundle\Entity\Ponencia')->findAll();

        return $this->render('DesymfonyBundle:Ponencia:index.html.twig', array('ponencias' => $ponencias));
    }

    public function ponenciaAction($slug)
    {
        $em       = $this->get('doctrine.orm.entity_manager');
        $ponencia = $em->getRepository('\Desymfony\DesymfonyBundle\Entity\Ponencia')
                       ->findOneBy(array('slug' => $slug));

        if($ponencia){

            $ponente = $ponencia->getPonente();
            return $this->render('DesymfonyBundle:Ponencia:ponencia.html.twig',
                                    array(
                                        'ponencia' => $ponencia,
                                        'ponente' => $ponente
                                        )
                    );
        }else{
            return $this->createNotFoundException();
        }
    }

    public function meApuntoAction($ponencia)
    {
        $usuario = $this->get('security.context')->getToken()->getUser();

        /*
         * Parece que aquí hay un bug de Symfony2 y el usuario no se serializa
         * correctamente.
         *
         * Podría pensarse que da lo mismo
         *
         * $apuntado = $ponencia->hasUsuario($usuario);
         *
         * o bien
         *
         * $apuntado = $usuarios->hasPonencia($ponencia);
         *
         * pero lo cierto es que lo segundo da un error que parece ser que nadie
         * sabe como resolver
         */

        return $this->render('DesymfonyBundle:Ponencia:meApunto.html.twig',
                                array('usuario' => $usuario, 'ponencia' => $ponencia)
                            );
    }

    public function apuntarseAction($slug)
    {
        $em       = $this->get('doctrine.orm.entity_manager');
        $ponencia = $em->getRepository('\Desymfony\DesymfonyBundle\Entity\Ponencia')
                       ->findOneBy(array('slug' => $slug));

        $request = $this->get('request');
        $request = new Request();

        if($ponencia){

            $usuario = $this->get('security.context')->getToken()->getUser();
            if($ponencia->addUsuarios($usuario)){;
                $em->persist($ponencia);
                $em->flush();
            }
            
            if($request->isXmlHttpRequest()){
                return new Response();
            }else{
                $session = $this->get('request')->getSession();
                $session->setFlash('notice', sprintf("Te has apuntado a %s", $ponencia->getTitulo()));
                return $this->redirect($this->generateUrl('ponencia', array('slug' => $ponencia->getSlug())));
            }

        }else{
            return $this->createNotFoundException();
        }
    }
    
}
