<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAvances
 *
 * @ORM\Table(name="ft_avances", indexes={@ORM\Index(name="i_ft_avances_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAvances
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_avances", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAvances;

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
    private $serieIdserie = '909';

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
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_formato", type="date", nullable=false)
     */
    private $fechaFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_formato", type="string", length=255, nullable=false)
     */
    private $descripcionFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAvances
     *
     * @return integer
     */
    public function getIdftAvances()
    {
        return $this->idftAvances;
    }

    /**
     * Set ftRecordarTarea
     *
     * @param integer $ftRecordarTarea
     *
     * @return FtAvances
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
     * @return FtAvances
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAvances
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
     * @return FtAvances
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
     * @return FtAvances
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
     * @return FtAvances
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
     * Set estado
     *
     * @param string $estado
     *
     * @return FtAvances
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaFormato
     *
     * @param \DateTime $fechaFormato
     *
     * @return FtAvances
     */
    public function setFechaFormato($fechaFormato)
    {
        $this->fechaFormato = $fechaFormato;

        return $this;
    }

    /**
     * Get fechaFormato
     *
     * @return \DateTime
     */
    public function getFechaFormato()
    {
        return $this->fechaFormato;
    }

    /**
     * Set descripcionFormato
     *
     * @param string $descripcionFormato
     *
     * @return FtAvances
     */
    public function setDescripcionFormato($descripcionFormato)
    {
        $this->descripcionFormato = $descripcionFormato;

        return $this;
    }

    /**
     * Get descripcionFormato
     *
     * @return string
     */
    public function getDescripcionFormato()
    {
        return $this->descripcionFormato;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAvances
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
