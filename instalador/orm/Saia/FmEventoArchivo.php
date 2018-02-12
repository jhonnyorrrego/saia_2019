<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FmEventoArchivo
 *
 * @ORM\Table(name="fm_evento_archivo", indexes={@ORM\Index(name="fk_fm_evento_archivo_fm_archivo1_idx", columns={"fm_archivo_idarchivo"}), @ORM\Index(name="fk_fm_evento_archivo_funcionario1_idx", columns={"funcionario_idfuncionario"}), @ORM\Index(name="fm_evento_archivo_accion", columns={"accion"})})
 * @ORM\Entity
 */
class FmEventoArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfm_evento_archivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfmEventoArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fm_archivo_idarchivo", type="integer", nullable=false)
     */
    private $fmArchivoIdarchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=50, nullable=false)
     */
    private $accion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;



    /**
     * Get idfmEventoArchivo
     *
     * @return integer
     */
    public function getIdfmEventoArchivo()
    {
        return $this->idfmEventoArchivo;
    }

    /**
     * Set fmArchivoIdarchivo
     *
     * @param integer $fmArchivoIdarchivo
     *
     * @return FmEventoArchivo
     */
    public function setFmArchivoIdarchivo($fmArchivoIdarchivo)
    {
        $this->fmArchivoIdarchivo = $fmArchivoIdarchivo;

        return $this;
    }

    /**
     * Get fmArchivoIdarchivo
     *
     * @return integer
     */
    public function getFmArchivoIdarchivo()
    {
        return $this->fmArchivoIdarchivo;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmEventoArchivo
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
     * Set accion
     *
     * @param string $accion
     *
     * @return FmEventoArchivo
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmEventoArchivo
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
}
