<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $ponenciasDia1 = $em->getRepository('DesymfonyBundle:Ponencia')->getTodasDeFecha('2011-07-01');
        $ponenciasDia2 = $em->getRepository('DesymfonyBundle:Ponencia')->getTodasDeFecha('2011-07-02');
        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('DesymfonyBundle:Default:index.html.twig', array(
            'ponenciasDia1' => $ponenciasDia1,
            'ponenciasDia2' => $ponenciasDia2,
            'usuario'       => $usuario,
        ));
    }

    /**
     * Muestra el contenido de una página estática (contacto, privacidad, etc.)
     *
     * @param string $pagina Nombre de la página que debe mostrarse
     */
    public function estaticaAction($pagina)
    {
        return $this->render(sprintf('DesymfonyBundle:Estaticas:%s.html.twig', $pagina));
    }

}
