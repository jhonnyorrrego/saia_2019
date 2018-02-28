<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaConfirmacion
 *
 * @ORM\Table(name="ft_prueba_confirmacion", indexes={@ORM\Index(name="i_prueba_confirmacion_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_prueba_confirmacion_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPruebaConfirmacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_confirmacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaConfirmacion;

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
     * @var integer
     *
     * @ORM\Column(name="estado_formato", type="integer", nullable=false)
     */
    private $estadoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_texto_nice", type="string", length=255, nullable=true)
     */
    private $campoTextoNice;

    /**
     * @var string
     *
     * @ORM\Column(name="oculto_mostrar", type="string", length=255, nullable=true)
     */
    private $ocultoMostrar;



    /**
     * Get idftPruebaConfirmacion
     *
     * @return integer
     */
    public function getIdftPruebaConfirmacion()
    {
        return $this->idftPruebaConfirmacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaConfirmacion
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
     * @return FtPruebaConfirmacion
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
     * @return FtPruebaConfirmacion
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
     * Set estadoFormato
     *
     * @param integer $estadoFormato
     *
     * @return FtPruebaConfirmacion
     */
    public function setEstadoFormato($estadoFormato)
    {
        $this->estadoFormato = $estadoFormato;

        return $this;
    }

    /**
     * Get estadoFormato
     *
     * @return integer
     */
    public function getEstadoFormato()
    {
        return $this->estadoFormato;
    }

    /**
     * Set campoTextoNice
     *
     * @param string $campoTextoNice
     *
     * @return FtPruebaConfirmacion
     */
    public function setCampoTextoNice($campoTextoNice)
    {
        $this->campoTextoNice = $campoTextoNice;

        return $this;
    }

    /**
     * Get campoTextoNice
     *
     * @return string
     */
    public function getCampoTextoNice()
    {
        return $this->campoTextoNice;
    }

    /**
     * Set ocultoMostrar
     *
     * @param string $ocultoMostrar
     *
     * @return FtPruebaConfirmacion
     */
    public function setOcultoMostrar($ocultoMostrar)
    {
        $this->ocultoMostrar = $ocultoMostrar;

        return $this;
    }

    /**
     * Get ocultoMostrar
     *
     * @return string
     */
    public function getOcultoMostrar()
    {
        return $this->ocultoMostrar;
    }
}
