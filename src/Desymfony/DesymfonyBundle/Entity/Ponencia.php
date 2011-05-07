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
     * @ManyToMany(targetEntity="Usuario", mappedBy="ponencias")
     * @JoinTable(name="ponencias_usuarios",
     *      joinColumns={@JoinColumn(name="usuario_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="ponencia_id", referencedColumnName="id")}
     *      )
     */
    protected $usuarios;

}
