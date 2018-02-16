<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroGrafica
 *
 * @ORM\Table(name="filtro_grafica")
 * @ORM\Entity
 */
class FiltroGrafica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfiltro_grafica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfiltroGrafica;

    /**
     * @var integer
     *
     * @ORM\Column(name="grafica_idgrafica", type="integer", nullable=false)
     */
    private $graficaIdgrafica;

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
     * Get idfiltroGrafica
     *
     * @return integer
     */
    public function getIdfiltroGrafica()
    {
        return $this->idfiltroGrafica;
    }

    /**
     * Set graficaIdgrafica
     *
     * @param integer $graficaIdgrafica
     *
     * @return FiltroGrafica
     */
    public function setGraficaIdgrafica($graficaIdgrafica)
    {
        $this->graficaIdgrafica = $graficaIdgrafica;

        return $this;
    }

    /**
     * Get graficaIdgrafica
     *
     * @return integer
     */
    public function getGraficaIdgrafica()
    {
        return $this->graficaIdgrafica;
    }

    /**
     * Set campo
     *
     * @param string $campo
     *
     * @return FiltroGrafica
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
     * @return FiltroGrafica
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
     * @return FiltroGrafica
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
     * @return FiltroGrafica
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
     * @return FiltroGrafica
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
