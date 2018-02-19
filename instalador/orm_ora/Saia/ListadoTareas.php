<?php

namespace Saia;

/**
 * ListadoTareas
 */
class ListadoTareas
{
    /**
     * @var integer
     */
    private $idlistadoTareas;

    /**
     * @var string
     */
    private $nombreLista;

    /**
     * @var string
     */
    private $descripcionLista;

    /**
     * @var integer
     */
    private $creadorLista;

    /**
     * @var string
     */
    private $clienteProyecto;

    /**
     * @var string
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

