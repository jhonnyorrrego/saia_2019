<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstTerminacion
 *
 * @ORM\Table(name="paso_inst_terminacion")
 * @ORM\Entity
 */
class PasoInstTerminacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_inst_terminacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoInstTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="instancia_idpaso_instancia", type="integer", nullable=false)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_justificacion", type="datetime", nullable=false)
     */
    private $fechaJustificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;



    /**
     * Get idpasoInstTerminacion
     *
     * @return integer
     */
    public function getIdpasoInstTerminacion()
    {
        return $this->idpasoInstTerminacion;
    }

    /**
     * Set documentoIdpasoDocumento
     *
     * @param integer $documentoIdpasoDocumento
     *
     * @return PasoInstTerminacion
     */
    public function setDocumentoIdpasoDocumento($documentoIdpasoDocumento)
    {
        $this->documentoIdpasoDocumento = $documentoIdpasoDocumento;

        return $this;
    }

    /**
     * Get documentoIdpasoDocumento
     *
     * @return integer
     */
    public function getDocumentoIdpasoDocumento()
    {
        return $this->documentoIdpasoDocumento;
    }

    /**
     * Set instanciaIdpasoInstancia
     *
     * @param integer $instanciaIdpasoInstancia
     *
     * @return PasoInstTerminacion
     */
    public function setInstanciaIdpasoInstancia($instanciaIdpasoInstancia)
    {
        $this->instanciaIdpasoInstancia = $instanciaIdpasoInstancia;

        return $this;
    }

    /**
     * Get instanciaIdpasoInstancia
     *
     * @return integer
     */
    public function getInstanciaIdpasoInstancia()
    {
        return $this->instanciaIdpasoInstancia;
    }

    /**
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return PasoInstTerminacion
     */
    public function setFuncionarioCodigo($funcionarioCodigo)
    {
        $this->funcionarioCodigo = $funcionarioCodigo;

        return $this;
    }

    /**
     * Get funcionarioCodigo
     *
     * @return integer
     */
    public function getFuncionarioCodigo()
    {
        return $this->funcionarioCodigo;
    }

    /**
     * Set fechaJustificacion
     *
     * @param \DateTime $fechaJustificacion
     *
     * @return PasoInstTerminacion
     */
    public function setFechaJustificacion($fechaJustificacion)
    {
        $this->fechaJustificacion = $fechaJustificacion;

        return $this;
    }

    /**
     * Get fechaJustificacion
     *
     * @return \DateTime
     */
    public function getFechaJustificacion()
    {
        return $this->fechaJustificacion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return PasoInstTerminacion
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
