<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCalificacionQrsf
 *
 * @ORM\Table(name="ft_calificacion_qrsf", indexes={@ORM\Index(name="i_ft_calificacion_qrsf_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_calificacion_qrsf_respuesta_", columns={"ft_respuesta_pqrsf"}), @ORM\Index(name="i_calificacion_qrsf_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtCalificacionQrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_calificacion_qrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCalificacionQrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_respuesta_pqrsf", type="integer", nullable=false)
     */
    private $ftRespuestaPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1195';

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion_pqrsf", type="integer", nullable=false)
     */
    private $calificacionPqrsf;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

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
     * Get idftCalificacionQrsf
     *
     * @return integer
     */
    public function getIdftCalificacionQrsf()
    {
        return $this->idftCalificacionQrsf;
    }

    /**
     * Set ftRespuestaPqrsf
     *
     * @param integer $ftRespuestaPqrsf
     *
     * @return FtCalificacionQrsf
     */
    public function setFtRespuestaPqrsf($ftRespuestaPqrsf)
    {
        $this->ftRespuestaPqrsf = $ftRespuestaPqrsf;

        return $this;
    }

    /**
     * Get ftRespuestaPqrsf
     *
     * @return integer
     */
    public function getFtRespuestaPqrsf()
    {
        return $this->ftRespuestaPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCalificacionQrsf
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
     * Set calificacionPqrsf
     *
     * @param integer $calificacionPqrsf
     *
     * @return FtCalificacionQrsf
     */
    public function setCalificacionPqrsf($calificacionPqrsf)
    {
        $this->calificacionPqrsf = $calificacionPqrsf;

        return $this;
    }

    /**
     * Get calificacionPqrsf
     *
     * @return integer
     */
    public function getCalificacionPqrsf()
    {
        return $this->calificacionPqrsf;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtCalificacionQrsf
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCalificacionQrsf
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
     * @return FtCalificacionQrsf
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
     * @return FtCalificacionQrsf
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
     * @return FtCalificacionQrsf
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
     * @return FtCalificacionQrsf
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
