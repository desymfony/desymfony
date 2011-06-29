<?php

namespace Desymfony\DesymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexaction()
    {
        
        return $this->render('DesymfonyBundle:Default:index.html.twig');
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
