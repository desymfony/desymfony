<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Desymfony\DesymfonyBundle\Validator\DNI;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @orm:Table(name="usuario")
 * @orm:Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\UsuarioRepository")
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
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id; 

    /**
    * @orm:Column(type="string")
    */
    protected $nombre;

    /**
    * @orm:Column(type="string")
    */
    protected $apellidos;

    /**
    * @orm:Column(type="string")
    */
    protected $dni;

    /**
    * @orm:Column(type="string")
    */
    protected $direccion;

    /**
    * @orm:Column(type="string")
    */
    protected $telefono;

    /**
    * @orm:Column(type="string")
    */
    protected $email;

    /**
    * @orm:Column(type="string")
    */
    protected $password;

    /**
    * @orm:ManyToMany(targetEntity="Ponencia", mappedBy="usuarios")
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
        $this->ponencias[] = $ponencias;
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