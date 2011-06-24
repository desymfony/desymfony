<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $ponenciasDiaUno = $em->getRepository('DesymfonyBundle:Ponencia')->findTodasDeFecha('2011-07-01');
        $ponenciasDiaDos = $em->getRepository('DesymfonyBundle:Ponencia')->findTodasDeFecha('2011-07-02');

        $format = $this->get('request')->getRequestFormat();

        return $this->render('DesymfonyBundle:Default:index.'.$format.'.twig', array(
            'ponenciasDiaUno' => $ponenciasDiaUno,
            'ponenciasDiaDos' => $ponenciasDiaDos,
        ));
    }

    /**
     * Muestra el contenido de una página estática (contacto, privacidad, etc.)
     *
     * @param string $pagina Nombre de la página que debe mostrarse
     */
    public function estaticaAction($pagina)
    {
        $format = $this->get('request')->getRequestFormat();

        return $this->render(sprintf('DesymfonyBundle:Estaticas:%s.'.$format.'.twig', $pagina));
    }

}
