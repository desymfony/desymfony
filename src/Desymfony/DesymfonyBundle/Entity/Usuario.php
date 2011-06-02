<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Security\Core\User\UserInterface;

use Desymfony\DesymfonyBundle\Validator\DNI;

/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /*
     * Implementation of UserInterface
     */

    public function getRoles(){
        return array('ROLE_USER');
    }

    public function getSalt(){
        return false;
    }

    public function getUsername(){
        return $this->email;
    }

    public function eraseCredentials(){

    }

    public function equals(UserInterface $user){
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
    */
    protected $nombre;

    /**
    * @ORM\Column(type="string")
    */
    protected $apellidos;

    /**
    * @ORM\Column(type="string")
    */
    protected $dni;

    /**
    * @ORM\Column(type="string")
    */
    protected $direccion;

    /**
    * @ORM\Column(type="string")
    */
    protected $telefono;

    /**
    * @ORM\Column(type="string")
    */
    protected $email;

    /**
    * @ORM\Column(type="string")
    */
    protected $password;

    /**
    * @ORM\ManyToMany(targetEntity="Ponencia", mappedBy="usuarios")
    */
    protected $ponencias;

    public function __construct() {
        $this->ponencias = new \Doctrine\Common\Collections\ArrayCollection();
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
        if(!$this->hasPonencia($ponencias)){
            $this->ponencias[] = $ponencias;
            return true;
        }

        return false;
    }

    public function hasPonencia(\Desymfony\DesymfonyBundle\Entity\Ponencia $ponencia)
    {
        foreach($this->ponencias as $value)
        {
            if($value->getId() == $ponencia->getId()){
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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nombre',    new NotBlank());
        $metadata->addPropertyConstraint('apellidos', new NotBlank());
        $metadata->addPropertyConstraint('dni',       new DNI());
        $metadata->addPropertyConstraint('email',     new Email());
        $metadata->addPropertyConstraint('email',     new NotBlank());
        $metadata->addPropertyConstraint('telefono',  new NotBlank());
        $metadata->addPropertyConstraint('password',  new NotBlank());
    }
}