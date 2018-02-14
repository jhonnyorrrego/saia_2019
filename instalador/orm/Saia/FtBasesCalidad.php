<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtBasesCalidad
 *
 * @ORM\Table(name="ft_bases_calidad", indexes={@ORM\Index(name="i_ft_bases_calidad_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtBasesCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_bases_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftBasesCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1251';

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
     * @ORM\Column(name="tipo_base_calidad", type="integer", nullable=false)
     */
    private $tipoBaseCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="version_base_calidad", type="string", length=255, nullable=true)
     */
    private $versionBaseCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_base", type="text", length=65535, nullable=true)
     */
    private $descripcionBase;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_base_calidad", type="string", length=255, nullable=false)
     */
    private $estadoBaseCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_soporte", type="string", length=255, nullable=true)
     */
    private $anexoSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftBasesCalidad
     *
     * @return integer
     */
    public function getIdftBasesCalidad()
    {
        return $this->idftBasesCalidad;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtBasesCalidad
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
     * @return FtBasesCalidad
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
     * @return FtBasesCalidad
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
     * @return FtBasesCalidad
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
     * @return FtBasesCalidad
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
     * Set tipoBaseCalidad
     *
     * @param integer $tipoBaseCalidad
     *
     * @return FtBasesCalidad
     */
    public function setTipoBaseCalidad($tipoBaseCalidad)
    {
        $this->tipoBaseCalidad = $tipoBaseCalidad;

        return $this;
    }

    /**
     * Get tipoBaseCalidad
     *
     * @return integer
     */
    public function getTipoBaseCalidad()
    {
        return $this->tipoBaseCalidad;
    }

    /**
     * Set versionBaseCalidad
     *
     * @param string $versionBaseCalidad
     *
     * @return FtBasesCalidad
     */
    public function setVersionBaseCalidad($versionBaseCalidad)
    {
        $this->versionBaseCalidad = $versionBaseCalidad;

        return $this;
    }

    /**
     * Get versionBaseCalidad
     *
     * @return string
     */
    public function getVersionBaseCalidad()
    {
        return $this->versionBaseCalidad;
    }

    /**
     * Set descripcionBase
     *
     * @param string $descripcionBase
     *
     * @return FtBasesCalidad
     */
    public function setDescripcionBase($descripcionBase)
    {
        $this->descripcionBase = $descripcionBase;

        return $this;
    }

    /**
     * Get descripcionBase
     *
     * @return string
     */
    public function getDescripcionBase()
    {
        return $this->descripcionBase;
    }

    /**
     * Set estadoBaseCalidad
     *
     * @param string $estadoBaseCalidad
     *
     * @return FtBasesCalidad
     */
    public function setEstadoBaseCalidad($estadoBaseCalidad)
    {
        $this->estadoBaseCalidad = $estadoBaseCalidad;

        return $this;
    }

    /**
     * Get estadoBaseCalidad
     *
     * @return string
     */
    public function getEstadoBaseCalidad()
    {
        return $this->estadoBaseCalidad;
    }

    /**
     * Set anexoSoporte
     *
     * @param string $anexoSoporte
     *
     * @return FtBasesCalidad
     */
    public function setAnexoSoporte($anexoSoporte)
    {
        $this->anexoSoporte = $anexoSoporte;

        return $this;
    }

    /**
     * Get anexoSoporte
     *
     * @return string
     */
    public function getAnexoSoporte()
    {
        return $this->anexoSoporte;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtBasesCalidad
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
