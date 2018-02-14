<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedades
 *
 * @ORM\Table(name="ft_novedades", indexes={@ORM\Index(name="i_ft_novedades_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtNovedades
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedades", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedades;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_readh", type="integer", nullable=false)
     */
    private $ftReadh;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1080';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_novedad", type="date", nullable=false)
     */
    private $fechaNovedad;

    /**
     * @var string
     *
     * @ORM\Column(name="novedad", type="text", length=65535, nullable=false)
     */
    private $novedad;

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
     * Get idftNovedades
     *
     * @return integer
     */
    public function getIdftNovedades()
    {
        return $this->idftNovedades;
    }

    /**
     * Set ftReadh
     *
     * @param integer $ftReadh
     *
     * @return FtNovedades
     */
    public function setFtReadh($ftReadh)
    {
        $this->ftReadh = $ftReadh;

        return $this;
    }

    /**
     * Get ftReadh
     *
     * @return integer
     */
    public function getFtReadh()
    {
        return $this->ftReadh;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNovedades
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
     * Set fechaNovedad
     *
     * @param \DateTime $fechaNovedad
     *
     * @return FtNovedades
     */
    public function setFechaNovedad($fechaNovedad)
    {
        $this->fechaNovedad = $fechaNovedad;

        return $this;
    }

    /**
     * Get fechaNovedad
     *
     * @return \DateTime
     */
    public function getFechaNovedad()
    {
        return $this->fechaNovedad;
    }

    /**
     * Set novedad
     *
     * @param string $novedad
     *
     * @return FtNovedades
     */
    public function setNovedad($novedad)
    {
        $this->novedad = $novedad;

        return $this;
    }

    /**
     * Get novedad
     *
     * @return string
     */
    public function getNovedad()
    {
        return $this->novedad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtNovedades
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
     * @return FtNovedades
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
     * @return FtNovedades
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
     * @return FtNovedades
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
     * @return FtNovedades
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
