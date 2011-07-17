<?php

namespace Desymfony\DesymfonyBundle\Form\Handler;

use
    Symfony\Component\Form\Form,
    Symfony\Component\HttpFoundation\Request,

    Desymfony\DesymfonyBundle\Model\UsuarioManager,
    Desymfony\DesymfonyBundle\Entity\Usuario,
    Desymfony\DesymfonyBundle\Form\Type\RegistroUsuarioType,
    Desymfony\DesymfonyBundle\Form\RegistroUsuario
;

class RegistroUsuarioHandler
{
    protected $request;

    protected $usuarioManager;
    
    protected $form;

    public function __construct(Form $form, Request $request, UsuarioManager $usuarioManager)
    {
        $this->request          = $request;
        $this->form             = $form;
        $this->usuarioManager   = $usuarioManager;
    }

    public function process(Usuario $usuario)
    {
        $registro = new RegistroUsuario($usuario, $this->usuarioManager);
        $this->form->setData($registro);

        if('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);
            
            if ($this->form->isValid()) {                
                $this->usuarioManager->updateUsuario($usuario);                                
                return true;
            }
        }

        return false;
    }
}
