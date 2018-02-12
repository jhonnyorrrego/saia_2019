<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAvanceNovedad
 *
 * @ORM\Table(name="ft_avance_novedad", indexes={@ORM\Index(name="i_ft_avance_novedad_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_avance_novedad_novedades", columns={"ft_novedades"}), @ORM\Index(name="i_avance_novedad_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtAvanceNovedad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_avance_novedad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAvanceNovedad;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_novedades", type="integer", nullable=false)
     */
    private $ftNovedades;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1081';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_avance", type="date", nullable=false)
     */
    private $fechaAvance;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_avance", type="text", length=65535, nullable=false)
     */
    private $descripcionAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_avance", type="integer", nullable=false)
     */
    private $estadoAvance;

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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAvanceNovedad
     *
     * @return integer
     */
    public function getIdftAvanceNovedad()
    {
        return $this->idftAvanceNovedad;
    }

    /**
     * Set ftNovedades
     *
     * @param integer $ftNovedades
     *
     * @return FtAvanceNovedad
     */
    public function setFtNovedades($ftNovedades)
    {
        $this->ftNovedades = $ftNovedades;

        return $this;
    }

    /**
     * Get ftNovedades
     *
     * @return integer
     */
    public function getFtNovedades()
    {
        return $this->ftNovedades;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAvanceNovedad
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
     * Set fechaAvance
     *
     * @param \DateTime $fechaAvance
     *
     * @return FtAvanceNovedad
     */
    public function setFechaAvance($fechaAvance)
    {
        $this->fechaAvance = $fechaAvance;

        return $this;
    }

    /**
     * Get fechaAvance
     *
     * @return \DateTime
     */
    public function getFechaAvance()
    {
        return $this->fechaAvance;
    }

    /**
     * Set descripcionAvance
     *
     * @param string $descripcionAvance
     *
     * @return FtAvanceNovedad
     */
    public function setDescripcionAvance($descripcionAvance)
    {
        $this->descripcionAvance = $descripcionAvance;

        return $this;
    }

    /**
     * Get descripcionAvance
     *
     * @return string
     */
    public function getDescripcionAvance()
    {
        return $this->descripcionAvance;
    }

    /**
     * Set estadoAvance
     *
     * @param integer $estadoAvance
     *
     * @return FtAvanceNovedad
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;

        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return integer
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAvanceNovedad
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
