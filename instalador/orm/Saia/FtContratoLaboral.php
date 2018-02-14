<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtContratoLaboral
 *
 * @ORM\Table(name="ft_contrato_laboral", indexes={@ORM\Index(name="i_ft_contrato_laboral_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtContratoLaboral
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_contrato_laboral", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftContratoLaboral;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_contrato", type="integer", nullable=false)
     */
    private $tipoContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="num_contarto", type="string", length=255, nullable=false)
     */
    private $numContarto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '897';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntar_documento", type="string", length=255, nullable=true)
     */
    private $adjuntarDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="sueldo_final", type="string", length=255, nullable=true)
     */
    private $sueldoFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="sueldo_ini", type="string", length=255, nullable=true)
     */
    private $sueldoIni;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftContratoLaboral
     *
     * @return integer
     */
    public function getIdftContratoLaboral()
    {
        return $this->idftContratoLaboral;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtContratoLaboral
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtContratoLaboral
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set tipoContrato
     *
     * @param integer $tipoContrato
     *
     * @return FtContratoLaboral
     */
    public function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;

        return $this;
    }

    /**
     * Get tipoContrato
     *
     * @return integer
     */
    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }

    /**
     * Set numContarto
     *
     * @param string $numContarto
     *
     * @return FtContratoLaboral
     */
    public function setNumContarto($numContarto)
    {
        $this->numContarto = $numContarto;

        return $this;
    }

    /**
     * Get numContarto
     *
     * @return string
     */
    public function getNumContarto()
    {
        return $this->numContarto;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return FtContratoLaboral
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return FtContratoLaboral
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtContratoLaboral
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtContratoLaboral
     */
    public function setFtHojaVida($ftHojaVida)
    {
        $this->ftHojaVida = $ftHojaVida;

        return $this;
    }

    /**
     * Get ftHojaVida
     *
     * @return integer
     */
    public function getFtHojaVida()
    {
        return $this->ftHojaVida;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtContratoLaboral
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtContratoLaboral
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set adjuntarDocumento
     *
     * @param string $adjuntarDocumento
     *
     * @return FtContratoLaboral
     */
    public function setAdjuntarDocumento($adjuntarDocumento)
    {
        $this->adjuntarDocumento = $adjuntarDocumento;

        return $this;
    }

    /**
     * Get adjuntarDocumento
     *
     * @return string
     */
    public function getAdjuntarDocumento()
    {
        return $this->adjuntarDocumento;
    }

    /**
     * Set sueldoFinal
     *
     * @param string $sueldoFinal
     *
     * @return FtContratoLaboral
     */
    public function setSueldoFinal($sueldoFinal)
    {
        $this->sueldoFinal = $sueldoFinal;

        return $this;
    }

    /**
     * Get sueldoFinal
     *
     * @return string
     */
    public function getSueldoFinal()
    {
        return $this->sueldoFinal;
    }

    /**
     * Set sueldoIni
     *
     * @param string $sueldoIni
     *
     * @return FtContratoLaboral
     */
    public function setSueldoIni($sueldoIni)
    {
        $this->sueldoIni = $sueldoIni;

        return $this;
    }

    /**
     * Get sueldoIni
     *
     * @return string
     */
    public function getSueldoIni()
    {
        return $this->sueldoIni;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtContratoLaboral
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}
