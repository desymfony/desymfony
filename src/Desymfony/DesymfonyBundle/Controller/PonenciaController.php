<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Desymfony\DesymfonyBundle\Entity\Ponencia;

class PonenciaController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('DesymfonyBundle:Ponencia');
        $paginator = $this->get('ideup.simple_paginator');

        $format = $this->get('request')->getRequestFormat();

        if ($format == 'html') {
            $paginator->setItemsPerPage(3, 'dia-uno');
            $ponenciasDiaUno = $paginator->paginate($repo->findTodasDeFechaQuery('2011-07-01'), 'dia-uno')->getResult();

            $paginator->setItemsPerPage(5, 'dia-dos');
            $ponenciasDiaDos = $paginator->paginate($repo->findTodasDeFechaQuery('2011-07-02'), 'dia-dos')->getResult();
        }
        else {
            $ponenciasDiaUno = $repo->findTodasDeFecha('2011-07-01');
            $ponenciasDiaDos = $repo->findTodasDeFecha('2011-07-02');
        }

        return $this->render('DesymfonyBundle:Ponencia:index.'.$format.'.twig', array(
            'ponenciasDiaUno' => $ponenciasDiaUno,
            'ponenciasDiaDos' => $ponenciasDiaDos,
            'paginator'       => $paginator,
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

        if ($ponencia) {

            $usuario = $this->get('security.context')->getToken()->getUser();

            if ($ponencia->addUsuarios($usuario)) {
                $em->persist($ponencia);
                $em->flush();
            }

            if ($request->isXmlHttpRequest()) {
                return $this->render('DesymfonyBundle:Ponencia:meApunto.html.twig', array('ponencia' => $ponencia));
            } else {
                $session = $this->get('request')->getSession();
                $session->setFlash('notice', sprintf("Te has apuntado a %s", $ponencia->getTitulo()));

                return $this->redirect($this->generateUrl('ponencia', array('slug' => $ponencia->getSlug())));
            }
        }
    }

}
