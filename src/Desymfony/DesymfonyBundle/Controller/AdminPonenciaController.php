<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Desymfony\DesymfonyBundle\Entity\Ponencia,
    Desymfony\DesymfonyBundle\Form\PonenciaType;

class AdminPonenciaController extends Controller
{
    public function listAction()
    {
        $em = $this->get('doctrine')->getEntityManager();

        return $this->render('DesymfonyBundle:AdminPonencia:list.html.twig', array(
            'ponencias' => $em->getRepository('DesymfonyBundle:Ponencia')->findAll()
        ));
    }

    public function newAction()
    {
        $peticion = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();

        $ponencia = new Ponencia();
        $ponencia->setFecha(new \DateTime('now'));
        $ponencia->setHora(new \DateTime('now'));

        $formulario = $this->get('form.factory')->create(new PonenciaType());
        $formulario->setData($ponencia);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {
                $em->persist($ponencia);
                $em->flush();

                $peticion->getSession()->setFlash('notice', 'Se ha creado correctamente la ponencia');

                return $this->redirect($this->generateUrl('admin_ponencia_edit', array(
                    'id' => $ponencia->getId()
                )));
            }
        }

        return $this->render('DesymfonyBundle:AdminPonencia:new.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

    public function editAction($id)
    {
        $peticion = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();

        if (null == $ponencia = $em->find('DesymfonyBundle:Ponencia', $id)) {
            throw new NotFoundHttpException('No existe la ponencia que se quiere modificar');
        }

        $formulario = $this->get('form.factory')->create(new PonenciaType());
        $formulario->setData($ponencia);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {
                $em->persist($ponencia);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_ponencia_list'));
            }
        }

        return $this->render('DesymfonyBundle:AdminPonencia:edit.html.twig', array(
            'formulario' => $formulario->createView(),
            'ponencia'   => $ponencia
        ));
    }

    public function showAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();

        if (null == $ponencia = $em->find('DesymfonyBundle:Ponencia', $id)) {
            throw new NotFoundHttpException('No existe la ponencia que se quiere ver');
        }

        return $this->render('DesymfonyBundle:AdminPonencia:show.html.twig', array(
            'ponencia'   => $ponencia
        ));
    }
}
