<?php

namespace Desymfony\DesymfonyBundle\Form;

use 
    Desymfony\DesymfonyBundle\Entity\Usuario,
    Desymfony\DesymfonyBundle\Model\UsuarioManager,
    Symfony\Component\Validator\Constraints as Assert,
    Symfony\Component\Validator\ExecutionContext

;

/**
 * @Assert\callback(methods={"isHumano"})
 */
class RegistroUsuario
{

    /**
     *
     * @var UsuarioManager
     */
    protected $usuarioManager;

    /**
     *
     * @var Usuario
     */
    public $usuario;

    /**
     *
     * @var boolean     
     */
    public $eresUnRobot;

     /**
     *
     * @param Usuario $usuario
     * @param UsuarioManager $usuarioManager
     */
    public function __construct(Usuario $usuario, UsuarioManager $usuarioManager)
    {
        $this->usuario = $usuario;
        $this->userManager = $usuarioManager;
    }

    /**
     * @param  ExecutionContext $context
     * @return bool
     */
    public function isHumano(ExecutionContext $context)
    {
        if ($this->eresUnRobot == true) {
            $property_path = $context->getPropertyPath() . '.eresUnRobot';
            $context->setPropertyPath($property_path);
            $context->addViolation('No eres humano machote!.', array(), null);
        }
    }
}
