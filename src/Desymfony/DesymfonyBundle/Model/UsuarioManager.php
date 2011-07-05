<?php

namespace Desymfony\DesymfonyBundle\Model;


use
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\UnitOfWork,
    Desymfony\DesymfonyBundle\Entity\Usuario,
    Symfony\Component\Security\Core\Encoder\EncoderFactory
;


/**
 * Description of UsuarioManager
 *
 * @author Fco Javier Aceituno
 */
class UsuarioManager {
    
    protected $em;
    protected $class;
    protected $repository;
    protected $encoder;

    public function __construct(EntityManager $em, EncoderFactory $encoder)
    {
        $this->em = $em;
        $this->class = 'DesymfonyBundle:Usuario';
        $this->repository = $em->getRepository($this->class);
        $this->encoder = $encoder;
    }

    public function getRepositorio()
    {
        return $this->repository;
    }

    public function updateUsuario(Usuario $usuario)
    {
        if ($this->em->getUnitOfWork()->getEntityState($usuario) == UnitOfWork::STATE_NEW) {
             // Codificamos el password la primera vez que se crea el usuario
            $password = $this->encoder->getEncoder($usuario)->
                encodePassword($usuario->getPassword(), $usuario->getSalt());
            $usuario->setPassword($password);
        }
        
        $this->em->persist($usuario);
        $this->em->flush();
    }

    public function createUsuario()
    {
        return new Usuario();
    }
}
