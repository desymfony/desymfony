<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Desymfony\DesymfonyBundle\Entity\Ponencia;

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
            return $this->render('DesymfonyBundle:Ponencia:ponencia.html.twig', array('ponencia' => $ponencia));
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}
