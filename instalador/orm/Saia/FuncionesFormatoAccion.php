<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormatoAccion
 *
 * @ORM\Table(name="funciones_formato_accion")
 * @ORM\Entity
 */
class FuncionesFormatoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_formato_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionesFormatoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_formato", type="integer", nullable=false)
     */
    private $idfuncionesFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="momento", type="string", length=20, nullable=false)
     */
    private $momento = 'ANTERIOR';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';



    /**
     * Get idfuncionesFormatoAccion
     *
     * @return integer
     */
    public function getIdfuncionesFormatoAccion()
    {
        return $this->idfuncionesFormatoAccion;
    }

    /**
     * Set idfuncionesFormato
     *
     * @param integer $idfuncionesFormato
     *
     * @return FuncionesFormatoAccion
     */
    public function setIdfuncionesFormato($idfuncionesFormato)
    {
        $this->idfuncionesFormato = $idfuncionesFormato;

        return $this;
    }

    /**
     * Get idfuncionesFormato
     *
     * @return integer
     */
    public function getIdfuncionesFormato()
    {
        return $this->idfuncionesFormato;
    }

    /**
     * Set accionIdaccion
     *
     * @param integer $accionIdaccion
     *
     * @return FuncionesFormatoAccion
     */
    public function setAccionIdaccion($accionIdaccion)
    {
        $this->accionIdaccion = $accionIdaccion;

        return $this;
    }

    /**
     * Get accionIdaccion
     *
     * @return integer
     */
    public function getAccionIdaccion()
    {
        return $this->accionIdaccion;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return FuncionesFormatoAccion
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set momento
     *
     * @param string $momento
     *
     * @return FuncionesFormatoAccion
     */
    public function setMomento($momento)
    {
        $this->momento = $momento;

        return $this;
    }

    /**
     * Get momento
     *
     * @return string
     */
    public function getMomento()
    {
        return $this->momento;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return FuncionesFormatoAccion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return FuncionesFormatoAccion
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }
}
