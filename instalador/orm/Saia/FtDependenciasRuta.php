<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDependenciasRuta
 *
 * @ORM\Table(name="ft_dependencias_ruta", indexes={@ORM\Index(name="i_dependencias_ruta_ruta_distr", columns={"ft_ruta_distribucion"}), @ORM\Index(name="i_dependencias_ruta_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtDependenciasRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_dependencias_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDependenciasRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_dependen", type="text", length=65535, nullable=true)
     */
    private $descripcionDependen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_ruta_distribucion", type="integer", nullable=false)
     */
    private $ftRutaDistribucion;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia_asignada", type="string", length=255, nullable=false)
     */
    private $dependenciaAsignada;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_item_dependenc", type="date", nullable=false)
     */
    private $fechaItemDependenc;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_dependencia", type="integer", nullable=false)
     */
    private $estadoDependencia = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_dependencia", type="integer", nullable=true)
     */
    private $ordenDependencia;



    /**
     * Get idftDependenciasRuta
     *
     * @return integer
     */
    public function getIdftDependenciasRuta()
    {
        return $this->idftDependenciasRuta;
    }

    /**
     * Set descripcionDependen
     *
     * @param string $descripcionDependen
     *
     * @return FtDependenciasRuta
     */
    public function setDescripcionDependen($descripcionDependen)
    {
        $this->descripcionDependen = $descripcionDependen;

        return $this;
    }

    /**
     * Get descripcionDependen
     *
     * @return string
     */
    public function getDescripcionDependen()
    {
        return $this->descripcionDependen;
    }

    /**
     * Set ftRutaDistribucion
     *
     * @param integer $ftRutaDistribucion
     *
     * @return FtDependenciasRuta
     */
    public function setFtRutaDistribucion($ftRutaDistribucion)
    {
        $this->ftRutaDistribucion = $ftRutaDistribucion;

        return $this;
    }

    /**
     * Get ftRutaDistribucion
     *
     * @return integer
     */
    public function getFtRutaDistribucion()
    {
        return $this->ftRutaDistribucion;
    }

    /**
     * Set dependenciaAsignada
     *
     * @param string $dependenciaAsignada
     *
     * @return FtDependenciasRuta
     */
    public function setDependenciaAsignada($dependenciaAsignada)
    {
        $this->dependenciaAsignada = $dependenciaAsignada;

        return $this;
    }

    /**
     * Get dependenciaAsignada
     *
     * @return string
     */
    public function getDependenciaAsignada()
    {
        return $this->dependenciaAsignada;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDependenciasRuta
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
     * Set fechaItemDependenc
     *
     * @param \DateTime $fechaItemDependenc
     *
     * @return FtDependenciasRuta
     */
    public function setFechaItemDependenc($fechaItemDependenc)
    {
        $this->fechaItemDependenc = $fechaItemDependenc;

        return $this;
    }

    /**
     * Get fechaItemDependenc
     *
     * @return \DateTime
     */
    public function getFechaItemDependenc()
    {
        return $this->fechaItemDependenc;
    }

    /**
     * Set estadoDependencia
     *
     * @param integer $estadoDependencia
     *
     * @return FtDependenciasRuta
     */
    public function setEstadoDependencia($estadoDependencia)
    {
        $this->estadoDependencia = $estadoDependencia;

        return $this;
    }

    /**
     * Get estadoDependencia
     *
     * @return integer
     */
    public function getEstadoDependencia()
    {
        return $this->estadoDependencia;
    }

    /**
     * Set ordenDependencia
     *
     * @param integer $ordenDependencia
     *
     * @return FtDependenciasRuta
     */
    public function setOrdenDependencia($ordenDependencia)
    {
        $this->ordenDependencia = $ordenDependencia;

        return $this;
    }

    /**
     * Get ordenDependencia
     *
     * @return integer
     */
    public function getOrdenDependencia()
    {
        return $this->ordenDependencia;
    }
}
