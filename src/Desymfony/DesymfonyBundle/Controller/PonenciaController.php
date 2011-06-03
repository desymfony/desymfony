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
        $ponencias = $this->entidad('Ponencia')->findAll();

        return $this->render('DesymfonyBundle:Ponencia:index.html.twig', array(
            'ponencias' => $ponencias
        ));
    }

    public function ponenciaAction($slug)
    {
        $ponencia = $this->entidad('Ponencia')->findOneBy(array('slug' => $slug));

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
        $ponencia = $this->entidad('Ponencia')->findOneBy(array('slug' => $slug));

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


    /**
     * Obtiene el repositorio de la entidad indicada
     *
     * @param string $entidad Nombre de la entidad de la que se quiere obtener el repositorio
     */
    private function entidad($entidad)
    {
        return $this->get('doctrine')->getEntityManager()
               ->getRepository('Desymfony\\DesymfonyBundle\\Entity\\'.$entidad);
    }
}
