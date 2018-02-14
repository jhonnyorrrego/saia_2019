<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCartaPqrsf
 *
 * @ORM\Table(name="ft_carta_pqrsf", indexes={@ORM\Index(name="i_ft_carta_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCartaPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_carta_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCartaPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1038';

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var integer
     *
     * @ORM\Column(name="copiainterna", type="integer", nullable=false)
     */
    private $copiainterna;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="destinos", type="text", length=65535, nullable=false)
     */
    private $destinos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carta", type="date", nullable=false)
     */
    private $fechaCarta;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="vercopiainterna", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

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
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var integer
     *
     * @ORM\Column(name="varios_radicados", type="integer", nullable=true)
     */
    private $variosRadicados;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_copia_interna", type="integer", nullable=false)
     */
    private $tipoCopiaInterna = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftCartaPqrsf
     *
     * @return integer
     */
    public function getIdftCartaPqrsf()
    {
        return $this->idftCartaPqrsf;
    }

    /**
     * Set ftPqrsf
     *
     * @param integer $ftPqrsf
     *
     * @return FtCartaPqrsf
     */
    public function setFtPqrsf($ftPqrsf)
    {
        $this->ftPqrsf = $ftPqrsf;

        return $this;
    }

    /**
     * Get ftPqrsf
     *
     * @return integer
     */
    public function getFtPqrsf()
    {
        return $this->ftPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCartaPqrsf
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtCartaPqrsf
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
     * Set contenido
     *
     * @param string $contenido
     *
     * @return FtCartaPqrsf
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
     * Set copia
     *
     * @param string $copia
     *
     * @return FtCartaPqrsf
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
     * Set copiainterna
     *
     * @param integer $copiainterna
     *
     * @return FtCartaPqrsf
     */
    public function setCopiainterna($copiainterna)
    {
        $this->copiainterna = $copiainterna;

        return $this;
    }

    /**
     * Get copiainterna
     *
     * @return integer
     */
    public function getCopiainterna()
    {
        return $this->copiainterna;
    }

    /**
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtCartaPqrsf
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
     * Set destinos
     *
     * @param string $destinos
     *
     * @return FtCartaPqrsf
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
     * Set fechaCarta
     *
     * @param \DateTime $fechaCarta
     *
     * @return FtCartaPqrsf
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
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtCartaPqrsf
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
     * Set vercopiainterna
     *
     * @param string $vercopiainterna
     *
     * @return FtCartaPqrsf
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtCartaPqrsf
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
     * Set variosRadicados
     *
     * @param integer $variosRadicados
     *
     * @return FtCartaPqrsf
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
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtCartaPqrsf
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
     * Set tipoCopiaInterna
     *
     * @param integer $tipoCopiaInterna
     *
     * @return FtCartaPqrsf
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCartaPqrsf
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
