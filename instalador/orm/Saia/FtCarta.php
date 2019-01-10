<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCarta
 *
 * @ORM\Table(name="ft_carta", indexes={@ORM\Index(name="i_ft_carta_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_carta_expediente", columns={"expediente_serie"}), @ORM\Index(name="i_carta_serie_idse", columns={"serie_idserie"}), @ORM\Index(name="carta_asunto", columns={"asunto"})})
 * @ORM\Entity
 */
class FtCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_carta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCarta;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="copiainterna", type="text", length=65535, nullable=true)
     */
    private $copiainterna;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carta", type="date", nullable=false)
     */
    private $fechaCarta;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="destinos", type="text", length=65535, nullable=false)
     */
    private $destinos;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="vercopiainterna", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

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
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="varios_radicados", type="integer", nullable=false)
     */
    private $variosRadicados;

    /**
     * @var string
     *
     * @ORM\Column(name="idflujo", type="string", length=255, nullable=true)
     */
    private $idflujo = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_copia_interna", type="integer", nullable=false)
     */
    private $tipoCopiaInterna = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="version_carta", type="string", length=10, nullable=false)
     */
    private $versionCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="email_aprobar", type="integer", nullable=false)
     */
    private $emailAprobar = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_serie", type="integer", nullable=true)
     */
    private $expedienteSerie;



    /**
     * Get idftCarta
     *
     * @return integer
     */
    public function getIdftCarta()
    {
        return $this->idftCarta;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return FtCarta
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set copiainterna
     *
     * @param string $copiainterna
     *
     * @return FtCarta
     */
    public function setCopiainterna($copiainterna)
    {
        $this->copiainterna = $copiainterna;

        return $this;
    }

    /**
     * Get copiainterna
     *
     * @return string
     */
    public function getCopiainterna()
    {
        return $this->copiainterna;
    }

    /**
     * Set fechaCarta
     *
     * @param \DateTime $fechaCarta
     *
     * @return FtCarta
     */
    public function setFechaCarta($fechaCarta)
    {
        $this->fechaCarta = $fechaCarta;

        return $this;
    }

    /**
     * Get fechaCarta
     *
     * @return \DateTime
     */
    public function getFechaCarta()
    {
        return $this->fechaCarta;
    }

    /**
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtCarta
     */
    public function setAnexosFisicos($anexosFisicos)
    {
        $this->anexosFisicos = $anexosFisicos;

        return $this;
    }

    /**
     * Get anexosFisicos
     *
     * @return string
     */
    public function getAnexosFisicos()
    {
        return $this->anexosFisicos;
    }

    /**
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtCarta
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;

        return $this;
    }

    /**
     * Get iniciales
     *
     * @return string
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }

    /**
     * Set copia
     *
     * @param string $copia
     *
     * @return FtCarta
     */
    public function setCopia($copia)
    {
        $this->copia = $copia;

        return $this;
    }

    /**
     * Get copia
     *
     * @return string
     */
    public function getCopia()
    {
        return $this->copia;
    }

    /**
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtCarta
     */
    public function setDespedida($despedida)
    {
        $this->despedida = $despedida;

        return $this;
    }

    /**
     * Get despedida
     *
     * @return string
     */
    public function getDespedida()
    {
        return $this->despedida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCarta
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
     * Set destinos
     *
     * @param string $destinos
     *
     * @return FtCarta
     */
    public function setDestinos($destinos)
    {
        $this->destinos = $destinos;

        return $this;
    }

    /**
     * Get destinos
     *
     * @return string
     */
    public function getDestinos()
    {
        return $this->destinos;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtCarta
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
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtCarta
     */
    public function setAnexosDigitales($anexosDigitales)
    {
        $this->anexosDigitales = $anexosDigitales;

        return $this;
    }

    /**
     * Get anexosDigitales
     *
     * @return string
     */
    public function getAnexosDigitales()
    {
        return $this->anexosDigitales;
    }

    /**
     * Set vercopiainterna
     *
     * @param string $vercopiainterna
     *
     * @return FtCarta
     */
    public function setVercopiainterna($vercopiainterna)
    {
        $this->vercopiainterna = $vercopiainterna;

        return $this;
    }

    /**
     * Get vercopiainterna
     *
     * @return string
     */
    public function getVercopiainterna()
    {
        return $this->vercopiainterna;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtCarta
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
     * @return FtCarta
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
     * @return FtCarta
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCarta
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
     * Set variosRadicados
     *
     * @param integer $variosRadicados
     *
     * @return FtCarta
     */
    public function setVariosRadicados($variosRadicados)
    {
        $this->variosRadicados = $variosRadicados;

        return $this;
    }

    /**
     * Get variosRadicados
     *
     * @return integer
     */
    public function getVariosRadicados()
    {
        return $this->variosRadicados;
    }

    /**
     * Set idflujo
     *
     * @param string $idflujo
     *
     * @return FtCarta
     */
    public function setIdflujo($idflujo)
    {
        $this->idflujo = $idflujo;

        return $this;
    }

    /**
     * Get idflujo
     *
     * @return string
     */
    public function getIdflujo()
    {
        return $this->idflujo;
    }

    /**
     * Set tipoCopiaInterna
     *
     * @param integer $tipoCopiaInterna
     *
     * @return FtCarta
     */
    public function setTipoCopiaInterna($tipoCopiaInterna)
    {
        $this->tipoCopiaInterna = $tipoCopiaInterna;

        return $this;
    }

    /**
     * Get tipoCopiaInterna
     *
     * @return integer
     */
    public function getTipoCopiaInterna()
    {
        return $this->tipoCopiaInterna;
    }

    /**
     * Set versionCarta
     *
     * @param string $versionCarta
     *
     * @return FtCarta
     */
    public function setVersionCarta($versionCarta)
    {
        $this->versionCarta = $versionCarta;

        return $this;
    }

    /**
     * Get versionCarta
     *
     * @return string
     */
    public function getVersionCarta()
    {
        return $this->versionCarta;
    }

    /**
     * Set emailAprobar
     *
     * @param integer $emailAprobar
     *
     * @return FtCarta
     */
    public function setEmailAprobar($emailAprobar)
    {
        $this->emailAprobar = $emailAprobar;

        return $this;
    }

    /**
     * Get emailAprobar
     *
     * @return integer
     */
    public function getEmailAprobar()
    {
        return $this->emailAprobar;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCarta
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

    /**
     * Set expedienteSerie
     *
     * @param integer $expedienteSerie
     *
     * @return FtCarta
     */
    public function setExpedienteSerie($expedienteSerie)
    {
        $this->expedienteSerie = $expedienteSerie;

        return $this;
    }

    /**
     * Get expedienteSerie
     *
     * @return integer
     */
    public function getExpedienteSerie()
    {
        return $this->expedienteSerie;
    }
}
