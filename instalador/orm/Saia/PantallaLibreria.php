<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaLibreria
 *
 * @ORM\Table(name="pantalla_libreria")
 * @ORM\Entity
 */
class PantallaLibreria
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
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=10, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_libreria", type="integer", nullable=false)
     */
    private $tipoLibreria = '2';



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
     * @return PantallaLibreria
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
     * @return PantallaLibreria
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
     * @return PantallaLibreria
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
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaLibreria
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

    /**
     * Set tipoArchivo
     *
     * @param string $tipoArchivo
     *
     * @return PantallaLibreria
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
     * Set tipoLibreria
     *
     * @param integer $tipoLibreria
     *
     * @return PantallaLibreria
     */
    public function setTipoLibreria($tipoLibreria)
    {
        $this->tipoLibreria = $tipoLibreria;

        return $this;
    }

    /**
     * Get tipoLibreria
     *
     * @return integer
     */
    public function getTipoLibreria()
    {
        return $this->tipoLibreria;
    }
}
