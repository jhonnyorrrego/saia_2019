<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaConfirApru
 *
 * @ORM\Table(name="ft_prueba_confir_apru", uniqueConstraints={@ORM\UniqueConstraint(name="item", columns={"item"})})
 * @ORM\Entity
 */
class FtPruebaConfirApru
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_confir_apru", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaConfirApru;

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
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1322';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="hola_mundo", type="string", length=255, nullable=true)
     */
    private $holaMundo;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=false)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255, nullable=true)
     */
    private $item;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_unico", type="string", length=255, nullable=false)
     */
    private $campoUnico;



    /**
     * Get idftPruebaConfirApru
     *
     * @return integer
     */
    public function getIdftPruebaConfirApru()
    {
        return $this->idftPruebaConfirApru;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPruebaConfirApru
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
     * @return FtPruebaConfirApru
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
     * @return FtPruebaConfirApru
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
     * @return FtPruebaConfirApru
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaConfirApru
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
     * @return FtPruebaConfirApru
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
     * Set holaMundo
     *
     * @param string $holaMundo
     *
     * @return FtPruebaConfirApru
     */
    public function setHolaMundo($holaMundo)
    {
        $this->holaMundo = $holaMundo;

        return $this;
    }

    /**
     * Get holaMundo
     *
     * @return string
     */
    public function getHolaMundo()
    {
        return $this->holaMundo;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtPruebaConfirApru
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
     * Set item
     *
     * @param string $item
     *
     * @return FtPruebaConfirApru
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set campoUnico
     *
     * @param string $campoUnico
     *
     * @return FtPruebaConfirApru
     */
    public function setCampoUnico($campoUnico)
    {
        $this->campoUnico = $campoUnico;

        return $this;
    }

    /**
     * Get campoUnico
     *
     * @return string
     */
    public function getCampoUnico()
    {
        return $this->campoUnico;
    }
}
