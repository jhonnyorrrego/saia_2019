<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudCompra
 *
 * @ORM\Table(name="ft_solicitud_compra")
 * @ORM\Entity
 */
class FtSolicitudCompra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia", type="string", length=255, nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_proyecto", type="string", length=255, nullable=false)
     */
    private $nombreProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=false)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_contrato", type="string", length=255, nullable=false)
     */
    private $tipoContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="objeto", type="text", length=65535, nullable=false)
     */
    private $objeto;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=false)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="cuantia", type="string", length=255, nullable=false)
     */
    private $cuantia;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="gerente_area", type="string", length=255, nullable=false)
     */
    private $gerenteArea;

    /**
     * @var string
     *
     * @ORM\Column(name="digitalizar", type="string", length=255, nullable=true)
     */
    private $digitalizar;



    /**
     * Get idftSolicitudCompra
     *
     * @return integer
     */
    public function getIdftSolicitudCompra()
    {
        return $this->idftSolicitudCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudCompra
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
     * @return FtSolicitudCompra
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
     * @param string $dependencia
     *
     * @return FtSolicitudCompra
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set nombreProyecto
     *
     * @param string $nombreProyecto
     *
     * @return FtSolicitudCompra
     */
    public function setNombreProyecto($nombreProyecto)
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    /**
     * Get nombreProyecto
     *
     * @return string
     */
    public function getNombreProyecto()
    {
        return $this->nombreProyecto;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return FtSolicitudCompra
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set tipoContrato
     *
     * @param string $tipoContrato
     *
     * @return FtSolicitudCompra
     */
    public function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;

        return $this;
    }

    /**
     * Get tipoContrato
     *
     * @return string
     */
    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }

    /**
     * Set objeto
     *
     * @param string $objeto
     *
     * @return FtSolicitudCompra
     */
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;

        return $this;
    }

    /**
     * Get objeto
     *
     * @return string
     */
    public function getObjeto()
    {
        return $this->objeto;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return FtSolicitudCompra
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set cuantia
     *
     * @param string $cuantia
     *
     * @return FtSolicitudCompra
     */
    public function setCuantia($cuantia)
    {
        $this->cuantia = $cuantia;

        return $this;
    }

    /**
     * Get cuantia
     *
     * @return string
     */
    public function getCuantia()
    {
        return $this->cuantia;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSolicitudCompra
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set gerenteArea
     *
     * @param string $gerenteArea
     *
     * @return FtSolicitudCompra
     */
    public function setGerenteArea($gerenteArea)
    {
        $this->gerenteArea = $gerenteArea;

        return $this;
    }

    /**
     * Get gerenteArea
     *
     * @return string
     */
    public function getGerenteArea()
    {
        return $this->gerenteArea;
    }

    /**
     * Set digitalizar
     *
     * @param string $digitalizar
     *
     * @return FtSolicitudCompra
     */
    public function setDigitalizar($digitalizar)
    {
        $this->digitalizar = $digitalizar;

        return $this;
    }

    /**
     * Get digitalizar
     *
     * @return string
     */
    public function getDigitalizar()
    {
        return $this->digitalizar;
    }
}
