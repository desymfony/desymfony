<?php

namespace Desymfony\DesymfonyBundle\Entity;


/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @orm:Table(name="ponente")
 * @orm:Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\PonenteRepository")
 */
class Ponente
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
     * @orm:Column(type="text")
     */
    protected $biografia;

    /**
     * @orm:Column(type="string")
     */
    protected $telefono;

    /**
     * @orm:Column(type="string")
     */
    protected $url;

    /**
     * @orm:Column(type="string")
     */
    protected $email;

    /**
     * @orm:Column(type="string")
     */
    protected $twitter;

    /**
     * @orm:Column(type="string")
     */
    protected $linkedin;

    /**
     * @orm:OneToMany(targetEntity="Ponencia", mappedBy="ponente")
     */
    private $ponencias;

    public function __construct() {
      $this->ponencias = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
