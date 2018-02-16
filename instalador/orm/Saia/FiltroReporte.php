<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroReporte
 *
 * @ORM\Table(name="filtro_reporte")
 * @ORM\Entity
 */
class FiltroReporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfiltro_reporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfiltroReporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="reporte_idreporte", type="integer", nullable=false)
     */
    private $reporteIdreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="campo", type="string", length=255, nullable=false)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_html", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="string", length=2000, nullable=true)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=false)
     */
    private $tipoDato = 'varchar';



    /**
     * Get idfiltroReporte
     *
     * @return integer
     */
    public function getIdfiltroReporte()
    {
        return $this->idfiltroReporte;
    }

    /**
     * Set reporteIdreporte
     *
     * @param integer $reporteIdreporte
     *
     * @return FiltroReporte
     */
    public function setReporteIdreporte($reporteIdreporte)
    {
        $this->reporteIdreporte = $reporteIdreporte;

        return $this;
    }

    /**
     * Get reporteIdreporte
     *
     * @return integer
     */
    public function getReporteIdreporte()
    {
        return $this->reporteIdreporte;
    }

    /**
     * Set campo
     *
     * @param string $campo
     *
     * @return FiltroReporte
     */
    public function setCampo($campo)
    {
        $this->campo = $campo;

        return $this;
    }

    /**
     * Get campo
     *
     * @return string
     */
    public function getCampo()
    {
        return $this->campo;
    }

    /**
     * Set etiquetaHtml
     *
     * @param string $etiquetaHtml
     *
     * @return FiltroReporte
     */
    public function setEtiquetaHtml($etiquetaHtml)
    {
        $this->etiquetaHtml = $etiquetaHtml;

        return $this;
    }

    /**
     * Get etiquetaHtml
     *
     * @return string
     */
    public function getEtiquetaHtml()
    {
        return $this->etiquetaHtml;
    }

    /**
     * Set codigoSql
     *
     * @param string $codigoSql
     *
     * @return FiltroReporte
     */
    public function setCodigoSql($codigoSql)
    {
        $this->codigoSql = $codigoSql;

        return $this;
    }

    /**
     * Get codigoSql
     *
     * @return string
     */
    public function getCodigoSql()
    {
        return $this->codigoSql;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return FiltroReporte
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set tipoDato
     *
     * @param string $tipoDato
     *
     * @return FiltroReporte
     */
    public function setTipoDato($tipoDato)
    {
        $this->tipoDato = $tipoDato;

        return $this;
    }

    /**
     * Get tipoDato
     *
     * @return string
     */
    public function getTipoDato()
    {
        return $this->tipoDato;
    }
}
