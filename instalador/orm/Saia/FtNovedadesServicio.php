<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadesServicio
 *
 * @ORM\Table(name="ft_novedades_servicio", indexes={@ORM\Index(name="i_ft_novedades_servicio_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtNovedadesServicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedades_servicio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadesServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_verifica_informacion", type="integer", nullable=false)
     */
    private $ftVerificaInformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '986';

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="string", length=255, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="copiainterna", type="text", length=65535, nullable=true)
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
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

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
     * @ORM\Column(name="saludo", type="string", length=255, nullable=true)
     */
    private $saludo;

    /**
     * @var integer
     *
     * @ORM\Column(name="varios_radicados", type="integer", nullable=false)
     */
    private $variosRadicados = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="vercopiainterna", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=false)
     */
    private $tipoMensajeria = '1';

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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftNovedadesServicio
     *
     * @return integer
     */
    public function getIdftNovedadesServicio()
    {
        return $this->idftNovedadesServicio;
    }

    /**
     * Set ftVerificaInformacion
     *
     * @param integer $ftVerificaInformacion
     *
     * @return FtNovedadesServicio
     */
    public function setFtVerificaInformacion($ftVerificaInformacion)
    {
        $this->ftVerificaInformacion = $ftVerificaInformacion;

        return $this;
    }

    /**
     * Get ftVerificaInformacion
     *
     * @return integer
     */
    public function getFtVerificaInformacion()
    {
        return $this->ftVerificaInformacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNovedadesServicio
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtNovedadesServicio
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtNovedadesServicio
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtNovedadesServicio
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtNovedadesServicio
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set copia
     *
     * @param string $copia
     *
     * @return FtNovedadesServicio
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
     * @param string $copiainterna
     *
     * @return FtNovedadesServicio
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
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return FtNovedadesServicio
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set saludo
     *
     * @param string $saludo
     *
     * @return FtNovedadesServicio
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
     * Set variosRadicados
     *
     * @param integer $variosRadicados
     *
     * @return FtNovedadesServicio
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
     * Set vercopiainterna
     *
     * @param string $vercopiainterna
     *
     * @return FtNovedadesServicio
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
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtNovedadesServicio
     */
    public function setTipoMensajeria($tipoMensajeria)
    {
        $this->tipoMensajeria = $tipoMensajeria;

        return $this;
    }

    /**
     * Get tipoMensajeria
     *
     * @return integer
     */
    public function getTipoMensajeria()
    {
        return $this->tipoMensajeria;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtNovedadesServicio
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
