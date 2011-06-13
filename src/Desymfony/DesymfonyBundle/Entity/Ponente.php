<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @ORM\Table(name="ponente")
 * @ORM\Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\PonenteRepository")
 */
class Ponente
{
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
     * @ORM\Column(type="text")
     */
    protected $biografia;

    /**
     * @ORM\Column(type="string")
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $twitter;

    /**
     * @ORM\Column(type="string")
     */
    protected $linkedin;

    /**
     * @ORM\OneToMany(targetEntity="Ponencia", mappedBy="ponente")
     */
    private $ponencias;

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
     * Set biografia
     *
     * @param text $biografia
     */
    public function setBiografia($biografia)
    {
        $this->biografia = $biografia;
    }

    /**
     * Get biografia
     *
     * @return text $biografia
     */
    public function getBiografia()
    {
        return $this->biografia;
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
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
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
     * Set twitter
     *
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Get twitter
     *
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * Get linkedin
     *
     * @return string $linkedin
     */
    public function getLinkedin()
    {
        return $this->linkedin;
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
}
