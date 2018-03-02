<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCierreTarea
 *
 * @ORM\Table(name="ft_cierre_tarea", indexes={@ORM\Index(name="i_ft_cierre_tarea_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCierreTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_cierre_tarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftCierreTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_recordar_tarea", type="integer", nullable=false)
     */
    private $ftRecordarTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '910';

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion_tarea", type="integer", nullable=false)
     */
    private $calificacionTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

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
     * Get idftCierreTarea
     *
     * @return integer
     */
    public function getIdftCierreTarea()
    {
        return $this->idftCierreTarea;
    }

    /**
     * Set ftRecordarTarea
     *
     * @param integer $ftRecordarTarea
     *
     * @return FtCierreTarea
     */
    public function setFtRecordarTarea($ftRecordarTarea)
    {
        $this->ftRecordarTarea = $ftRecordarTarea;

        return $this;
    }

    /**
     * Get ftRecordarTarea
     *
     * @return integer
     */
    public function getFtRecordarTarea()
    {
        return $this->ftRecordarTarea;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCierreTarea
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
     * Set calificacionTarea
     *
     * @param integer $calificacionTarea
     *
     * @return FtCierreTarea
     */
    public function setCalificacionTarea($calificacionTarea)
    {
        $this->calificacionTarea = $calificacionTarea;

        return $this;
    }

    /**
     * Get calificacionTarea
     *
     * @return integer
     */
    public function getCalificacionTarea()
    {
        return $this->calificacionTarea;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtCierreTarea
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtCierreTarea
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCierreTarea
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
     * @return FtCierreTarea
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
     * @return FtCierreTarea
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
     * @return FtCierreTarea
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
     * @return FtCierreTarea
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
