<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Desymfony\DesymfonyBundle\Resources\util\Util;

/**
 * Desymfony\DesymfonyBundle\Entity
 *
 * @ORM\Table(name="ponencia")
 * @ORM\Entity(repositoryClass="Desymfony\DesymfonyBundle\Entity\PonenciaRepository")
 */
class Ponencia
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    protected $titulo;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\MinLength(50)
     */
    protected $descripcion;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    protected $fecha;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time()
     */
    protected $hora;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Min(0)
     */
    protected $duracion;

    /**
     * @ORM\Column(type="string", length="2")
     * @Assert\Choice({"es", "en"})
     */
    protected $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="Ponente", inversedBy="ponencias", cascade={"remove"})
     * @ORM\JoinColumn(name="ponente_id", referencedColumnName="id")
     */
    protected $ponente;

    /**
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="ponencias")
     * @ORM\JoinTable(name="ponencia_usuario",
     *      joinColumns={@ORM\JoinColumn(name="ponencia_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
     * )
     */
    protected $usuarios;

    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitulo();
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
        $this->setSlug(Util::slugify($titulo));
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
     * Set descripcion
     *
     * @param text $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return text $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date $fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param time $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * Get hora
     *
     * @return time $hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Get horaFinalizacion
     *
     * @return time $horafinalizacion
     */
    public function getHoraFinalizacion()
    {
        return $this->hora->add(new \DateInterval('PT'. $this->duracion . 'M'));
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
    public function addUsuarios(\Desymfony\DesymfonyBundle\Entity\Usuario $usuario)
    {
        if (!$this->hasUsuario($usuario)) {
            $this->usuarios[] = $usuario;
            return true;
        }

        return false;
    }

    public function hasUsuario(\Desymfony\DesymfonyBundle\Entity\Usuario $usuario)
    {
        foreach ($this->usuarios as $value) {
            if ($value->getId() == $usuario->getId()) {
                return true;
            }
        }

        return false;
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
