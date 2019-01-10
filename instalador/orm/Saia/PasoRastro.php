<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoRastro
 *
 * @ORM\Table(name="paso_rastro")
 * @ORM\Entity
 */
class PasoRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_rastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoRastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_original", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_final", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="datetime", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;



    /**
     * Get idpasoRastro
     *
     * @return integer
     */
    public function getIdpasoRastro()
    {
        return $this->idpasoRastro;
    }

    /**
     * Set documentoIdpasoDocumento
     *
     * @param integer $documentoIdpasoDocumento
     *
     * @return PasoRastro
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
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return PasoRastro
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
     * Set estadoOriginal
     *
     * @param integer $estadoOriginal
     *
     * @return PasoRastro
     */
    public function setEstadoOriginal($estadoOriginal)
    {
        $this->estadoOriginal = $estadoOriginal;

        return $this;
    }

    /**
     * Get estadoOriginal
     *
     * @return integer
     */
    public function getEstadoOriginal()
    {
        return $this->estadoOriginal;
    }

    /**
     * Set estadoFinal
     *
     * @param integer $estadoFinal
     *
     * @return PasoRastro
     */
    public function setEstadoFinal($estadoFinal)
    {
        $this->estadoFinal = $estadoFinal;

        return $this;
    }

    /**
     * Get estadoFinal
     *
     * @return integer
     */
    public function getEstadoFinal()
    {
        return $this->estadoFinal;
    }

    /**
     * Set fechaCambio
     *
     * @param \DateTime $fechaCambio
     *
     * @return PasoRastro
     */
    public function setFechaCambio($fechaCambio)
    {
        $this->fechaCambio = $fechaCambio;

        return $this;
    }

    /**
     * Get fechaCambio
     *
     * @return \DateTime
     */
    public function getFechaCambio()
    {
        return $this->fechaCambio;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return PasoRastro
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
