<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRutaDistribucion
 *
 * @ORM\Table(name="ft_ruta_distribucion", indexes={@ORM\Index(name="i_ruta_distribucion_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_ruta_distribucion_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtRutaDistribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_ruta_distribucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRutaDistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

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
     * @ORM\Column(name="descripcion_ruta", type="text", length=65535, nullable=true)
     */
    private $descripcionRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_ruta", type="string", length=255, nullable=false)
     */
    private $nombreRuta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ruta_distribuc", type="date", nullable=false)
     */
    private $fechaRutaDistribuc;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1280';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="asignar_dependencias", type="text", length=65535, nullable=false)
     */
    private $asignarDependencias;

    /**
     * @var string
     *
     * @ORM\Column(name="asignar_mensajeros", type="string", length=255, nullable=false)
     */
    private $asignarMensajeros;



    /**
     * Get idftRutaDistribucion
     *
     * @return integer
     */
    public function getIdftRutaDistribucion()
    {
        return $this->idftRutaDistribucion;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtRutaDistribucion
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtRutaDistribucion
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtRutaDistribucion
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
     * @return FtRutaDistribucion
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
     * Set descripcionRuta
     *
     * @param string $descripcionRuta
     *
     * @return FtRutaDistribucion
     */
    public function setDescripcionRuta($descripcionRuta)
    {
        $this->descripcionRuta = $descripcionRuta;

        return $this;
    }

    /**
     * Get descripcionRuta
     *
     * @return string
     */
    public function getDescripcionRuta()
    {
        return $this->descripcionRuta;
    }

    /**
     * Set nombreRuta
     *
     * @param string $nombreRuta
     *
     * @return FtRutaDistribucion
     */
    public function setNombreRuta($nombreRuta)
    {
        $this->nombreRuta = $nombreRuta;

        return $this;
    }

    /**
     * Get nombreRuta
     *
     * @return string
     */
    public function getNombreRuta()
    {
        return $this->nombreRuta;
    }

    /**
     * Set fechaRutaDistribuc
     *
     * @param \DateTime $fechaRutaDistribuc
     *
     * @return FtRutaDistribucion
     */
    public function setFechaRutaDistribuc($fechaRutaDistribuc)
    {
        $this->fechaRutaDistribuc = $fechaRutaDistribuc;

        return $this;
    }

    /**
     * Get fechaRutaDistribuc
     *
     * @return \DateTime
     */
    public function getFechaRutaDistribuc()
    {
        return $this->fechaRutaDistribuc;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRutaDistribucion
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
     * @param string $estadoDocumento
     *
     * @return FtRutaDistribucion
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set asignarDependencias
     *
     * @param string $asignarDependencias
     *
     * @return FtRutaDistribucion
     */
    public function setAsignarDependencias($asignarDependencias)
    {
        $this->asignarDependencias = $asignarDependencias;

        return $this;
    }

    /**
     * Get asignarDependencias
     *
     * @return string
     */
    public function getAsignarDependencias()
    {
        return $this->asignarDependencias;
    }

    /**
     * Set asignarMensajeros
     *
     * @param string $asignarMensajeros
     *
     * @return FtRutaDistribucion
     */
    public function setAsignarMensajeros($asignarMensajeros)
    {
        $this->asignarMensajeros = $asignarMensajeros;

        return $this;
    }

    /**
     * Get asignarMensajeros
     *
     * @return string
     */
    public function getAsignarMensajeros()
    {
        return $this->asignarMensajeros;
    }
}
