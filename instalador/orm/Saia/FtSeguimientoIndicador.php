<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeguimientoIndicador
 *
 * @ORM\Table(name="ft_seguimiento_indicador", indexes={@ORM\Index(name="i_seguimiento_indicad_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_seguimiento_indicad_formula_in", columns={"ft_formula_indicador"}), @ORM\Index(name="i_seguimiento_indicad_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSeguimientoIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeguimientoIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_formula_indicador", type="integer", nullable=false)
     */
    private $ftFormulaIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1260';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="linea_base", type="string", length=255, nullable=true)
     */
    private $lineaBase;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_indicador_actual", type="string", length=20, nullable=false)
     */
    private $metaIndicadorActual;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=255, nullable=false)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSeguimientoIndicador
     *
     * @return integer
     */
    public function getIdftSeguimientoIndicador()
    {
        return $this->idftSeguimientoIndicador;
    }

    /**
     * Set ftFormulaIndicador
     *
     * @param integer $ftFormulaIndicador
     *
     * @return FtSeguimientoIndicador
     */
    public function setFtFormulaIndicador($ftFormulaIndicador)
    {
        $this->ftFormulaIndicador = $ftFormulaIndicador;

        return $this;
    }

    /**
     * Get ftFormulaIndicador
     *
     * @return integer
     */
    public function getFtFormulaIndicador()
    {
        return $this->ftFormulaIndicador;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeguimientoIndicador
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
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return FtSeguimientoIndicador
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set lineaBase
     *
     * @param string $lineaBase
     *
     * @return FtSeguimientoIndicador
     */
    public function setLineaBase($lineaBase)
    {
        $this->lineaBase = $lineaBase;

        return $this;
    }

    /**
     * Get lineaBase
     *
     * @return string
     */
    public function getLineaBase()
    {
        return $this->lineaBase;
    }

    /**
     * Set metaIndicadorActual
     *
     * @param string $metaIndicadorActual
     *
     * @return FtSeguimientoIndicador
     */
    public function setMetaIndicadorActual($metaIndicadorActual)
    {
        $this->metaIndicadorActual = $metaIndicadorActual;

        return $this;
    }

    /**
     * Get metaIndicadorActual
     *
     * @return string
     */
    public function getMetaIndicadorActual()
    {
        return $this->metaIndicadorActual;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSeguimientoIndicador
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeguimientoIndicador
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
     * Set resultado
     *
     * @param string $resultado
     *
     * @return FtSeguimientoIndicador
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSeguimientoIndicador
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSeguimientoIndicador
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSeguimientoIndicador
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSeguimientoIndicador
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
