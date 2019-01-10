<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFormulaIndicador
 *
 * @ORM\Table(name="ft_formula_indicador", indexes={@ORM\Index(name="i_ft_formula_indicador_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_formula_indicador_indicadore", columns={"ft_indicadores_calidad"}), @ORM\Index(name="i_formula_indicador_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtFormulaIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_formula_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFormulaIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_indicadores_calidad", type="integer", nullable=false)
     */
    private $ftIndicadoresCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="naturaleza", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $naturaleza = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="periocidad", type="string", length=255, nullable=true)
     */
    private $periocidad = '180';

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=50, nullable=false)
     */
    private $unidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rango_colores", type="string", length=255, nullable=false)
     */
    private $rangoColores;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_rango", type="integer", nullable=false)
     */
    private $tipoRango = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2542';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftFormulaIndicador
     *
     * @return integer
     */
    public function getIdftFormulaIndicador()
    {
        return $this->idftFormulaIndicador;
    }

    /**
     * Set ftIndicadoresCalidad
     *
     * @param integer $ftIndicadoresCalidad
     *
     * @return FtFormulaIndicador
     */
    public function setFtIndicadoresCalidad($ftIndicadoresCalidad)
    {
        $this->ftIndicadoresCalidad = $ftIndicadoresCalidad;

        return $this;
    }

    /**
     * Get ftIndicadoresCalidad
     *
     * @return integer
     */
    public function getFtIndicadoresCalidad()
    {
        return $this->ftIndicadoresCalidad;
    }

    /**
     * Set naturaleza
     *
     * @param string $naturaleza
     *
     * @return FtFormulaIndicador
     */
    public function setNaturaleza($naturaleza)
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    /**
     * Get naturaleza
     *
     * @return string
     */
    public function getNaturaleza()
    {
        return $this->naturaleza;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtFormulaIndicador
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return FtFormulaIndicador
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set periocidad
     *
     * @param string $periocidad
     *
     * @return FtFormulaIndicador
     */
    public function setPeriocidad($periocidad)
    {
        $this->periocidad = $periocidad;

        return $this;
    }

    /**
     * Get periocidad
     *
     * @return string
     */
    public function getPeriocidad()
    {
        return $this->periocidad;
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     *
     * @return FtFormulaIndicador
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set rangoColores
     *
     * @param string $rangoColores
     *
     * @return FtFormulaIndicador
     */
    public function setRangoColores($rangoColores)
    {
        $this->rangoColores = $rangoColores;

        return $this;
    }

    /**
     * Get rangoColores
     *
     * @return string
     */
    public function getRangoColores()
    {
        return $this->rangoColores;
    }

    /**
     * Set tipoRango
     *
     * @param integer $tipoRango
     *
     * @return FtFormulaIndicador
     */
    public function setTipoRango($tipoRango)
    {
        $this->tipoRango = $tipoRango;

        return $this;
    }

    /**
     * Get tipoRango
     *
     * @return integer
     */
    public function getTipoRango()
    {
        return $this->tipoRango;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtFormulaIndicador
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtFormulaIndicador
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
     * @return FtFormulaIndicador
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
     * @return FtFormulaIndicador
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFormulaIndicador
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtFormulaIndicador
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
