<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Validator\Mapping\ClassMetadata;

use Desymfony\DesymfonyBundle\Validator\DNI;

/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity()
 * @UniqueEntity(fields="email")
 */
class Usuario implements UserInterface, \Serializable
{
    /*
     * Implementation of UserInterface
     */

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return false;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {

    }

    public function equals(UserInterface $user)
    {
        return $user->getUsername() == $this->getUsername();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @Assert\MinLength(3)
    * @Assert\MaxLength(20)
    */
    protected $nombre;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @Assert\MinLength(3)
    * @Assert\MaxLength(20)
    */
    protected $apellidos;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @DNI()
    */
    protected $dni;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @Assert\MinLength(5)
    * @Assert\MaxLength(100)
    */
    protected $direccion;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    */
    protected $telefono;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    protected $email;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank()
    * @Assert\MinLength(5)
    * @Assert\MaxLength(10)
    */
    protected $password;

    /**
    * @ORM\ManyToMany(targetEntity="Ponencia", mappedBy="usuarios")
    */
    protected $ponencias;

    public function __construct()
    {
        $this->ponencias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getNombreCompleto();
    }

    public function getNombreCompleto()
    {
        return $this->getNombre().' '.$this->getApellidos();
    }

    public function serialize()
    {
        return serialize(array(
            $this->getEmail()
        ));
    }

    public function unserialize($serialized)
    {
        $arr = unserialize($serialized);
        $this->setEmail($arr[0]);
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * Get apellidos
     *
     * @return string $apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Get dni
     *
     * @return string $dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return string $direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Get telefono
     *
     * @return string $telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add ponencias
     *
     * @param Desymfony\DesymfonyBundle\Entity\Ponencia $ponencias
     */
    public function addPonencias(\Desymfony\DesymfonyBundle\Entity\Ponencia $ponencias)
    {
        if (!$this->hasPonencia($ponencias)) {
            $this->ponencias[] = $ponencias;
            return true;
        }

        return false;
    }

    public function hasPonencia(\Desymfony\DesymfonyBundle\Entity\Ponencia $ponencia)
    {
        foreach ($this->ponencias as $value) {
            if ($value->getId() == $ponencia->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get ponencias
     *
     * @return Doctrine\Common\Collections\Collection $ponencias
     */
    public function getPonencias()
    {
        return $this->ponencias;
    }

    /**
     * Get numero de ponencias
     *
     * @return integer $numeroPonencias
     */
    public function getNumeroPonencias()
    {
        return count($this->ponencias);
    }

    /*
     * Dejo comentado este código para que se viera como se haría mediante código PHP
     * Creo que en ocasiones puede ser preferible esta manera por tener todas las
     * validaciones a un sólo vistazo

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // Validación global
        $metadata->addConstraint(new UniqueEntity(array('fields' => 'email')));

        // Nombre
        $metadata->addPropertyConstraint('nombre',    new Assert\NotBlank()   );
        $metadata->addPropertyConstraint('nombre',    new Assert\MinLength(3) );
        $metadata->addPropertyConstraint('nombre',    new Assert\MaxLength(20));

        // Apellidos
        $metadata->addPropertyConstraint('apellidos', new Assert\NotBlank()   );
        $metadata->addPropertyConstraint('apellidos', new Assert\MinLength(3) );
        $metadata->addPropertyConstraint('apellidos', new Assert\MaxLength(20));

        // DNI
        $metadata->addPropertyConstraint('dni'      , new Assert\NotBlank()   );
        $metadata->addPropertyConstraint('dni'      , new DNI() );

        // Dirección
        $metadata->addPropertyConstraint('direccion', new Assert\NotBlank()   );
        $metadata->addPropertyConstraint('direccion', new Assert\MinLength(5) );
        $metadata->addPropertyConstraint('direccion', new Assert\MaxLength(100));

        // Telefóno
        $metadata->addPropertyConstraint('telefono' , new Assert\NotBlank());

        // Contraseña
        $metadata->addPropertyConstraint('password',  new Assert\NotBlank());
        $metadata->addPropertyConstraint('password',  new Assert\MinLength(5) );
        $metadata->addPropertyConstraint('password',  new Assert\MaxLength(10));

        // Email
        $metadata->addPropertyConstraint('email'   ,  new Assert\NotBlank());
        $metadata->addPropertyConstraint('email'   ,  new Assert\Email() );


        $metadata->addPropertyConstraint('password',  new Assert\NotBlank());
    }
     *
     */
}
