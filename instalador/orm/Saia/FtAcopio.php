<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAcopio
 *
 * @ORM\Table(name="ft_acopio", indexes={@ORM\Index(name="i_ft_acopio_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAcopio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acopio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAcopio;

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
    private $serieIdserie = '1082';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_acopio", type="integer", nullable=true)
     */
    private $tipoAcopio;

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
     * @ORM\Column(name="estado_acopio", type="integer", nullable=false)
     */
    private $estadoAcopio;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAcopio
     *
     * @return integer
     */
    public function getIdftAcopio()
    {
        return $this->idftAcopio;
    }

    /**
     * Set ftReadh
     *
     * @param integer $ftReadh
     *
     * @return FtAcopio
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
     * @return FtAcopio
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
     * Set tipoAcopio
     *
     * @param integer $tipoAcopio
     *
     * @return FtAcopio
     */
    public function setTipoAcopio($tipoAcopio)
    {
        $this->tipoAcopio = $tipoAcopio;

        return $this;
    }

    /**
     * Get tipoAcopio
     *
     * @return integer
     */
    public function getTipoAcopio()
    {
        return $this->tipoAcopio;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAcopio
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
     * @return FtAcopio
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
     * @return FtAcopio
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
     * @return FtAcopio
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
     * Set estadoAcopio
     *
     * @param integer $estadoAcopio
     *
     * @return FtAcopio
     */
    public function setEstadoAcopio($estadoAcopio)
    {
        $this->estadoAcopio = $estadoAcopio;

        return $this;
    }

    /**
     * Get estadoAcopio
     *
     * @return integer
     */
    public function getEstadoAcopio()
    {
        return $this->estadoAcopio;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAcopio
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
