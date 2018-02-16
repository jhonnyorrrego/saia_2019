<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraficoSerie
 *
 * @ORM\Table(name="grafico_serie")
 * @ORM\Entity
 */
class GraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idgrafico_serie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idgraficoSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="text", length=16777215, nullable=false)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="grafico_idgrafico", type="integer", nullable=false)
     */
    private $graficoIdgrafico;



    /**
     * Get idgraficoSerie
     *
     * @return integer
     */
    public function getIdgraficoSerie()
    {
        return $this->idgraficoSerie;
    }

    /**
     * Set codigoSql
     *
     * @param string $codigoSql
     *
     * @return GraficoSerie
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return GraficoSerie
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return GraficoSerie
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
     * Set graficoIdgrafico
     *
     * @param integer $graficoIdgrafico
     *
     * @return GraficoSerie
     */
    public function setGraficoIdgrafico($graficoIdgrafico)
    {
        $this->graficoIdgrafico = $graficoIdgrafico;

        return $this;
    }

    /**
     * Get graficoIdgrafico
     *
     * @return integer
     */
    public function getGraficoIdgrafico()
    {
        return $this->graficoIdgrafico;
    }
}
