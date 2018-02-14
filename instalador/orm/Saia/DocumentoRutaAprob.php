<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoRutaAprob
 *
 * @ORM\Table(name="documento_ruta_aprob")
 * @ORM\Entity
 */
class DocumentoRutaAprob
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_ruta_aprob", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoRutaAprob;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_ruta_aprob", type="integer", nullable=true)
     */
    private $estadoRutaAprob = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="idfunc_creador", type="integer", nullable=false)
     */
    private $idfuncCreador;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprobacion_en", type="integer", nullable=false)
     */
    private $aprobacionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;



    /**
     * Get iddocumentoRutaAprob
     *
     * @return integer
     */
    public function getIddocumentoRutaAprob()
    {
        return $this->iddocumentoRutaAprob;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoRutaAprob
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
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return DocumentoRutaAprob
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set estadoRutaAprob
     *
     * @param integer $estadoRutaAprob
     *
     * @return DocumentoRutaAprob
     */
    public function setEstadoRutaAprob($estadoRutaAprob)
    {
        $this->estadoRutaAprob = $estadoRutaAprob;

        return $this;
    }

    /**
     * Get estadoRutaAprob
     *
     * @return integer
     */
    public function getEstadoRutaAprob()
    {
        return $this->estadoRutaAprob;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return DocumentoRutaAprob
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set idfuncCreador
     *
     * @param integer $idfuncCreador
     *
     * @return DocumentoRutaAprob
     */
    public function setIdfuncCreador($idfuncCreador)
    {
        $this->idfuncCreador = $idfuncCreador;

        return $this;
    }

    /**
     * Get idfuncCreador
     *
     * @return integer
     */
    public function getIdfuncCreador()
    {
        return $this->idfuncCreador;
    }

    /**
     * Set aprobacionEn
     *
     * @param integer $aprobacionEn
     *
     * @return DocumentoRutaAprob
     */
    public function setAprobacionEn($aprobacionEn)
    {
        $this->aprobacionEn = $aprobacionEn;

        return $this;
    }

    /**
     * Get aprobacionEn
     *
     * @return integer
     */
    public function getAprobacionEn()
    {
        return $this->aprobacionEn;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return DocumentoRutaAprob
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return DocumentoRutaAprob
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
}
