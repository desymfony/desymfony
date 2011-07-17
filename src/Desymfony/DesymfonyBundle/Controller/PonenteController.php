<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PonenteController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $ponentes = $em->getRepository('DesymfonyBundle:Ponente')->findTodosAlfabeticamente();

        $format = $this->get('request')->getRequestFormat();
        return $this->render('DesymfonyBundle:Ponente:index.'.$format.'.twig', array(
            'ponentes' => $ponentes
        ));
    }
}
