<?php

namespace Desymfony\DesymfonyBundle\Entity;


/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @orm:Table(name="usuario")
 * @orm:Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\UsuarioRepository")
 */
class Usuario
{
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
    * @ManyToMany(targetEntity="Ponencia", mappedBy="usuarios")
    */
    protected $ponencias;
}
