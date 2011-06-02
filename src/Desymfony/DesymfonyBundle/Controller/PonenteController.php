<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PonenteController extends Controller
{
    public function indexAction()
    {
        $dql      = "SELECT p FROM Desymfony\DesymfonyBundle\Entity\Ponente p ORDER BY p.nombre ASC";
        $em       = $this->get('doctrine')->getEntityManager();
        $ponentes = $em->createQuery($dql)->getResult();
        return $this->render('DesymfonyBundle:Ponente:index.html.twig', array('ponentes' => $ponentes));
    }
}
