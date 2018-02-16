<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaRastro
 *
 * @ORM\Table(name="paso_instancia_rastro")
 * @ORM\Entity
 */
class PasoInstanciaRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_instancia_rastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoInstanciaRastro;

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
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_idpaso_inst", type="integer", nullable=false)
     */
    private $instIdpasoInst;



    /**
     * Get idpasoInstanciaRastro
     *
     * @return integer
     */
    public function getIdpasoInstanciaRastro()
    {
        return $this->idpasoInstanciaRastro;
    }

    /**
     * Set instanciaIdpasoInstancia
     *
     * @param integer $instanciaIdpasoInstancia
     *
     * @return PasoInstanciaRastro
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
     * @return PasoInstanciaRastro
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
     * @return PasoInstanciaRastro
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
     * @return PasoInstanciaRastro
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
     * @return PasoInstanciaRastro
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
     * @return PasoInstanciaRastro
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

    /**
     * Set documentoIdpasoDocumento
     *
     * @param integer $documentoIdpasoDocumento
     *
     * @return PasoInstanciaRastro
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
     * Set instIdpasoInst
     *
     * @param integer $instIdpasoInst
     *
     * @return PasoInstanciaRastro
     */
    public function setInstIdpasoInst($instIdpasoInst)
    {
        $this->instIdpasoInst = $instIdpasoInst;

        return $this;
    }

    /**
     * Get instIdpasoInst
     *
     * @return integer
     */
    public function getInstIdpasoInst()
    {
        return $this->instIdpasoInst;
    }
}
