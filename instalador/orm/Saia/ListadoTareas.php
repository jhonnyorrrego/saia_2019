<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListadoTareas
 *
 * @ORM\Table(name="listado_tareas")
 * @ORM\Entity
 */
class ListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlistado_tareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idlistadoTareas;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_lista", type="string", length=255, nullable=false)
     */
    private $nombreLista;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_lista", type="text", length=65535, nullable=true)
     */
    private $descripcionLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="creador_lista", type="integer", nullable=false)
     */
    private $creadorLista;

    /**
     * @var string
     *
     * @ORM\Column(name="cliente_proyecto", type="string", length=255, nullable=true)
     */
    private $clienteProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="macro_proceso", type="string", length=255, nullable=true)
     */
    private $macroProceso;



    /**
     * Get idlistadoTareas
     *
     * @return integer
     */
    public function getIdlistadoTareas()
    {
        return $this->idlistadoTareas;
    }

    /**
     * Set nombreLista
     *
     * @param string $nombreLista
     *
     * @return ListadoTareas
     */
    public function setNombreLista($nombreLista)
    {
        $this->nombreLista = $nombreLista;

        return $this;
    }

    /**
     * Get nombreLista
     *
     * @return string
     */
    public function getNombreLista()
    {
        return $this->nombreLista;
    }

    /**
     * Set descripcionLista
     *
     * @param string $descripcionLista
     *
     * @return ListadoTareas
     */
    public function setDescripcionLista($descripcionLista)
    {
        $this->descripcionLista = $descripcionLista;

        return $this;
    }

    /**
     * Get descripcionLista
     *
     * @return string
     */
    public function getDescripcionLista()
    {
        return $this->descripcionLista;
    }

    /**
     * Set creadorLista
     *
     * @param integer $creadorLista
     *
     * @return ListadoTareas
     */
    public function setCreadorLista($creadorLista)
    {
        $this->creadorLista = $creadorLista;

        return $this;
    }

    /**
     * Get creadorLista
     *
     * @return integer
     */
    public function getCreadorLista()
    {
        return $this->creadorLista;
    }

    /**
     * Set clienteProyecto
     *
     * @param string $clienteProyecto
     *
     * @return ListadoTareas
     */
    public function setClienteProyecto($clienteProyecto)
    {
        $this->clienteProyecto = $clienteProyecto;

        return $this;
    }

    /**
     * Get clienteProyecto
     *
     * @return string
     */
    public function getClienteProyecto()
    {
        return $this->clienteProyecto;
    }

    /**
     * Set macroProceso
     *
     * @param string $macroProceso
     *
     * @return ListadoTareas
     */
    public function setMacroProceso($macroProceso)
    {
        $this->macroProceso = $macroProceso;

        return $this;
    }

    /**
     * Get macroProceso
     *
     * @return string
     */
    public function getMacroProceso()
    {
        return $this->macroProceso;
    }
}
