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

        $ponenciasDiaUno = $em->getRepository('DesymfonyBundle:Ponencia')->findTodasDeFecha('2011-07-01');
        $ponenciasDiaDos = $em->getRepository('DesymfonyBundle:Ponencia')->findTodasDeFecha('2011-07-02');

        $format = $this->get('request')->getRequestFormat();

        return $this->render('DesymfonyBundle:Ponencia:index.'.$format.'.twig', array(
            'ponenciasDiaUno' => $ponenciasDiaUno,
            'ponenciasDiaDos' => $ponenciasDiaDos,
        ));
    }

    public function ponenciaAction($slug)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $ponencia = $em->getRepository('DesymfonyBundle:Ponencia')->findOneBy(array('slug' => $slug));

        if (!$ponencia) {
            throw new NotFoundHttpException("No existe la ponencia indicada");
        }

        $format = $this->get('request')->getRequestFormat();

        return $this->render('DesymfonyBundle:Ponencia:ponencia.'.$format.'.twig', array(
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
