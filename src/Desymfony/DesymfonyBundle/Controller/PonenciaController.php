<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Desymfony\DesymfonyBundle\Entity\Ponencia;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PonenciaController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        
        $ponencias = $em->getRepository('DesymfonyBundle:Ponencia')->findAll();
        
        return $this->render('DesymfonyBundle:Ponencia:index.html.twig', array(
            'ponencias' => $ponencias
        ));
    }

    public function ponenciaAction($slug)
    {
        $em = $this->get('doctrine')->getEntityManager();
        
        $ponencia = $em->getRepository('DesymfonyBundle:Ponencia')->findOneBy(array('slug' => $slug));
        
        if (!$ponencia) {
            throw new NotFoundHttpException("No existe la ponencia indicada");
        }
        
        return $this->render('DesymfonyBundle:Ponencia:ponencia.html.twig', array(
            'ponencia' => $ponencia
        ));
    }

    public function apuntarseAction($slug)
    {
        $em = $this->get('doctrine')->getEntityManager();
        
        $ponencia = $em->getRepository('DesymfonyBundle:Ponencia')->findOneBy(array('slug' => $slug));

        $request = $this->get('request');
        $request = new Request();

        if ($ponencia) {
            $usuario = $this->get('security.context')->getToken()->getUser();

            if ($ponencia->addUsuarios($usuario)) {
                $em->persist($ponencia);
                $em->flush();
            }

            if ($request->isXmlHttpRequest()) {
                return new Response();
            }
            else {
                $session = $this->get('request')->getSession();
                $session->setFlash('notice', sprintf("Te has apuntado a %s", $ponencia->getTitulo()));

                return $this->redirect($this->generateUrl('ponencia', array('slug' => $ponencia->getSlug())));
            }
        }
    }

}
