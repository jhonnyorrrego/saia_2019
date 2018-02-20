<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaLibreriaDef
 *
 * @ORM\Table(name="pantalla_libreria_def")
 * @ORM\Entity
 */
class PantallaLibreriaDef
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_libreria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=10, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_incluir", type="string", length=255, nullable=false)
     */
    private $lugarIncluir = 'head';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;


    /**
     * Get idpantallaLibreria
     *
     * @return integer
     */
    public function getIdpantallaLibreria()
    {
        return $this->idpantallaLibreria;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return PantallaLibreriaDef
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return PantallaLibreriaDef
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PantallaLibreriaDef
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return PantallaLibreriaDef
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
     * Set tipoArchivo
     *
     * @param string $tipoArchivo
     *
     * @return PantallaLibreriaDef
     */
    public function setTipoArchivo($tipoArchivo)
    {
        $this->tipoArchivo = $tipoArchivo;

        return $this;
    }

    /**
     * Get tipoArchivo
     *
     * @return string
     */
    public function getTipoArchivo()
    {
        return $this->tipoArchivo;
    }

    /**
     * Set lugarIncluir
     *
     * @param string $lugarIncluir
     *
     * @return PantallaLibreriaDef
     */
    public function setLugarIncluir($lugarIncluir)
    {
        $this->lugarIncluir = $lugarIncluir;

        return $this;
    }

    /**
     * Get lugarIncluir
     *
     * @return string
     */
    public function getLugarIncluir()
    {
        return $this->lugarIncluir;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaLibreriaDef
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
