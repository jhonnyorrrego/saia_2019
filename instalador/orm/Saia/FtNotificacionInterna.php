<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNotificacionInterna
 *
 * @ORM\Table(name="ft_notificacion_interna", indexes={@ORM\Index(name="i_ft_notificacion_interna_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_notificacion_interna_destino", columns={"destino"}), @ORM\Index(name="i_notificacion_interna_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtNotificacionInterna
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_notificacion_interna", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNotificacionInterna;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_a", type="string", length=200, nullable=false)
     */
    private $copiaA;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=200, nullable=false)
     */
    private $destino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="saludo", type="string", length=255, nullable=false)
     */
    private $saludo;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=false)
     */
    private $despedida;

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
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="string", length=255, nullable=false)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '911';

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftNotificacionInterna
     *
     * @return integer
     */
    public function getIdftNotificacionInterna()
    {
        return $this->idftNotificacionInterna;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set copiaA
     *
     * @param string $copiaA
     *
     * @return FtNotificacionInterna
     */
    public function setCopiaA($copiaA)
    {
        $this->copiaA = $copiaA;

        return $this;
    }

    /**
     * Get copiaA
     *
     * @return string
     */
    public function getCopiaA()
    {
        return $this->copiaA;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return FtNotificacionInterna
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtNotificacionInterna
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set saludo
     *
     * @param string $saludo
     *
     * @return FtNotificacionInterna
     */
    public function setSaludo($saludo)
    {
        $this->saludo = $saludo;

        return $this;
    }

    /**
     * Get saludo
     *
     * @return string
     */
    public function getSaludo()
    {
        return $this->saludo;
    }

    /**
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtNotificacionInterna
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtNotificacionInterna
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtNotificacionInterna
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtNotificacionInterna
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNotificacionInterna
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
     * Set origen
     *
     * @param integer $origen
     *
     * @return FtNotificacionInterna
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtNotificacionInterna
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
