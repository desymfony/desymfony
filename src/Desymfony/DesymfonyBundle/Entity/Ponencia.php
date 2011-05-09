<?php

namespace Desymfony\DesymfonyBundle\Entity;


/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @orm:Table(name="ponencia")
 * @orm:Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\PonenciaRepository")
 */
class Ponencia
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
    protected $titulo;

    /**
     * @orm:Column(type="string")
     */
    protected $slug;

    /**
     * @orm:Column(type="text")
     */
    protected $descriptcion;

    /**
     * @orm:Column(type="datetime")
     */
    protected $fecha;

    /**
     * @orm:Column(type="integer")
     */
    protected $duracion;

    /**
     * @orm:Column(type="string", length="2")
     */
    protected $idioma;

    /**
     * @orm:ManyToOne(targetEntity="Ponente", inversedBy="ponencias", cascade={"remove"})
     * @orm:JoinColumn(name="ponente_id", referencedColumnName="id")
     */
    protected $ponente;

    /**
     * @orm:ManyToMany(targetEntity="Usuario", inversedBy="ponencias")
     * @orm:JoinTable(name="ponencia_usuario",
     *      joinColumns={@orm:JoinColumn(name="ponencia_id", referencedColumnName="id")},
     *      inverseJoinColumns={@orm:JoinColumn(name="usuario_id", referencedColumnName="id")}
     * )
     */
    protected $usuarios;

    public function __construct() {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string $titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set descriptcion
     *
     * @param text $descriptcion
     */
    public function setDescriptcion($descriptcion)
    {
        $this->descriptcion = $descriptcion;
    }

    /**
     * Get descriptcion
     *
     * @return text $descriptcion
     */
    public function getDescriptcion()
    {
        return $this->descriptcion;
    }

    /**
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime $fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * Get duracion
     *
     * @return integer $duracion
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    /**
     * Get idioma
     *
     * @return string $idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set ponente
     *
     * @param Desymfony\DesymfonyBundle\Entity\Ponente $ponente
     */
    public function setPonente(\Desymfony\DesymfonyBundle\Entity\Ponente $ponente)
    {
        $this->ponente = $ponente;
    }

    /**
     * Get ponente
     *
     * @return Desymfony\DesymfonyBundle\Entity\Ponente $ponente
     */
    public function getPonente()
    {
        return $this->ponente;
    }

    /**
     * Add usuarios
     *
     * @param Desymfony\DesymfonyBundle\Entity\Usuario $usuarios
     */
    public function addUsuarios(\Desymfony\DesymfonyBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection $usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
