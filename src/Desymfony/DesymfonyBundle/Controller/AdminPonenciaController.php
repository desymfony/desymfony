<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Desymfony\DesymfonyBundle\Entity\Ponencia,
    Desymfony\DesymfonyBundle\Form\PonenciaType;

class AdminPonenciaController extends Controller
{
    public function listAction()
    {
        return $this->render('DesymfonyBundle:AdminPonencia:list.html.twig', array(
            'ponencias' => $this->entidad('Ponencia')->findAll()
        ));
    }
    
    public function newAction()
    {
        $peticion = $this->get('request');
        $em = $this->get('doctrine.orm.entity_manager');

        $ponencia = new Ponencia();
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

        return $this->render('DesymfonyBundle:AdminPonencia:new.html.twig', array(
            'formulario' => $formulario->createView(),
        ));
    }
    
    public function editAction($id)
    {
        $peticion = $this->get('request');
        $em = $this->get('doctrine.orm.entity_manager');
        
        if(null == $ponencia = $this->entidad('Ponencia')->findOneById($id)) {
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
