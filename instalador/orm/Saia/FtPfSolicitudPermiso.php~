<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPfSolicitudPermiso
 *
 * @ORM\Table(name="ft_pf_solicitud_permiso", indexes={@ORM\Index(name="i_pf_solicitud_permiso_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_pf_solicitud_permiso_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPfSolicitudPermiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_pf_solicitud_permiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPfSolicitudPermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1213';

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_dias", type="integer", nullable=true)
     */
    private $cantidadDias;

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
     * Get idftPfSolicitudPermiso
     *
     * @return integer
     */
    public function getIdftPfSolicitudPermiso()
    {
        return $this->idftPfSolicitudPermiso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPfSolicitudPermiso
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
     * Set cantidadDias
     *
     * @param integer $cantidadDias
     *
     * @return FtPfSolicitudPermiso
     */
    public function setCantidadDias($cantidadDias)
    {
        $this->cantidadDias = $cantidadDias;

        return $this;
    }

    /**
     * Get cantidadDias
     *
     * @return integer
     */
    public function getCantidadDias()
    {
        return $this->cantidadDias;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
}
