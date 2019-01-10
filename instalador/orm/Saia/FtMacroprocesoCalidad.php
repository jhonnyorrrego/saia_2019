<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMacroprocesoCalidad
 *
 * @ORM\Table(name="ft_macroproceso_calidad", indexes={@ORM\Index(name="i_ft_macroproceso_calidad_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_macroproceso_calidad_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtMacroprocesoCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_macroproceso_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftMacroprocesoCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2543';

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
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="des_formato", type="text", length=65535, nullable=true)
     */
    private $desFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="caracterizacion", type="string", length=255, nullable=true)
     */
    private $caracterizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftMacroprocesoCalidad
     *
     * @return integer
     */
    public function getIdftMacroprocesoCalidad()
    {
        return $this->idftMacroprocesoCalidad;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtMacroprocesoCalidad
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtMacroprocesoCalidad
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtMacroprocesoCalidad
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtMacroprocesoCalidad
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
     * @return FtMacroprocesoCalidad
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtMacroprocesoCalidad
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
     * Set desFormato
     *
     * @param string $desFormato
     *
     * @return FtMacroprocesoCalidad
     */
    public function setDesFormato($desFormato)
    {
        $this->desFormato = $desFormato;

        return $this;
    }

    /**
     * Get desFormato
     *
     * @return string
     */
    public function getDesFormato()
    {
        return $this->desFormato;
    }

    /**
     * Set caracterizacion
     *
     * @param string $caracterizacion
     *
     * @return FtMacroprocesoCalidad
     */
    public function setCaracterizacion($caracterizacion)
    {
        $this->caracterizacion = $caracterizacion;

        return $this;
    }

    /**
     * Get caracterizacion
     *
     * @return string
     */
    public function getCaracterizacion()
    {
        return $this->caracterizacion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtMacroprocesoCalidad
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
