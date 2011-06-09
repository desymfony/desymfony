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

        $ponenciasDiaUno = $em->getRepository('DesymfonyBundle:Ponencia')
            ->findTodasDeFecha('2011-07-01');
        $ponenciasDiaDos = $em->getRepository('DesymfonyBundle:Ponencia')
            ->findTodasDeFecha('2011-07-02');

        return $this->render('DesymfonyBundle:Ponencia:index.html.twig', array(
            'ponenciasDia1' => $ponenciasDiaUno,
            'ponenciasDia2' => $ponenciasDiaDos,
        ));
    }

    public function ponenciaAction($slug)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $ponencia = $em->getRepository('DesymfonyBundle:Ponencia')
        ->findOneBy(array('slug' => $slug));

        if (!$ponencia) {
            throw new NotFoundHttpException("No existe la ponencia indicada");
        }

        return $this->render('DesymfonyBundle:Ponencia:ponencia.html.twig',
            array(
            'ponencia' => $ponencia
            )
        );
    }

    public function apuntarseAction($slug)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $ponencia = $em->getRepository('DesymfonyBundle:Ponencia')
            ->findOneBy(array('slug' => $slug));

        $request = $this->get('request');

        if ($ponencia) {

            $usuario = $this->get('security.context')->getToken()->getUser();

            if ($ponencia->addUsuarios($usuario)) {
                $em->persist($ponencia);
                $em->flush();
            }

            if ($request->isXmlHttpRequest()) {
                return $this->render(
                    'DesymfonyBundle:Ponencia:meApunto.html.twig',
                    array('ponencia' => $ponencia)
                );
            } else {
                $session = $this->get('request')->getSession();
                $session->setFlash(
                    'notice',
                    sprintf("Te has apuntado a %s", $ponencia->getTitulo())
                );

                return $this->redirect(
                    $this->generateUrl(
                        'ponencia',
                        array('slug' => $ponencia->getSlug())
                    )
                );
            }
        }
    }

}
