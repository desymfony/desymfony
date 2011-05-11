<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminPonenciaController extends Controller
{
    public function listAction()
    {
        return $this->render('DesymfonyBundle:AdminPonencia:list.html.twig', array(
            'ponencias' => $this->entidad('Ponencia')->findAll()
        ));
    }
    
    
    
    
    
    
    
    
    /**
     * Obtiene el repositorio de la entidad indicada
     *
     * @param string $entidad Nombre de la entidad de la que se quiere obtener el repositorio
     */
    private function entidad($entidad)
    {
        return $this->get('doctrine.orm.entity_manager')
               ->getRepository('Desymfony\\DesymfonyBundle\\Entity\\'.$entidad);
    }
}
