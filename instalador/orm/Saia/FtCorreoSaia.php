<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCorreoSaia
 *
 * @ORM\Table(name="ft_correo_saia", indexes={@ORM\Index(name="i_ft_correo_saia_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCorreoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_correo_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCorreoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1210';

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="de", type="string", length=255, nullable=false)
     */
    private $de;

    /**
     * @var string
     *
     * @ORM\Column(name="para", type="text", length=65535, nullable=false)
     */
    private $para;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="text", length=65535, nullable=true)
     */
    private $anexos;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio_entrada", type="datetime", nullable=false)
     */
    private $fechaOficioEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255, nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255, nullable=true)
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferencia_correo", type="integer", nullable=true)
     */
    private $transferenciaCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_correo", type="string", length=255, nullable=true)
     */
    private $copiaCorreo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftCorreoSaia
     *
     * @return integer
     */
    public function getIdftCorreoSaia()
    {
        return $this->idftCorreoSaia;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCorreoSaia
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
     * @return FtCorreoSaia
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
     * Set de
     *
     * @param string $de
     *
     * @return FtCorreoSaia
     */
    public function setDe($de)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return string
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set para
     *
     * @param string $para
     *
     * @return FtCorreoSaia
     */
    public function setPara($para)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return string
     */
    public function getPara()
    {
        return $this->para;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtCorreoSaia
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCorreoSaia
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
     * @return FtCorreoSaia
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
     * @return FtCorreoSaia
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
     * @return FtCorreoSaia
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
     * Set fechaOficioEntrada
     *
     * @param \DateTime $fechaOficioEntrada
     *
     * @return FtCorreoSaia
     */
    public function setFechaOficioEntrada($fechaOficioEntrada)
    {
        $this->fechaOficioEntrada = $fechaOficioEntrada;

        return $this;
    }

    /**
     * Get fechaOficioEntrada
     *
     * @return \DateTime
     */
    public function getFechaOficioEntrada()
    {
        return $this->fechaOficioEntrada;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return FtCorreoSaia
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return FtCorreoSaia
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set transferenciaCorreo
     *
     * @param integer $transferenciaCorreo
     *
     * @return FtCorreoSaia
     */
    public function setTransferenciaCorreo($transferenciaCorreo)
    {
        $this->transferenciaCorreo = $transferenciaCorreo;

        return $this;
    }

    /**
     * Get transferenciaCorreo
     *
     * @return integer
     */
    public function getTransferenciaCorreo()
    {
        return $this->transferenciaCorreo;
    }

    /**
     * Set copiaCorreo
     *
     * @param string $copiaCorreo
     *
     * @return FtCorreoSaia
     */
    public function setCopiaCorreo($copiaCorreo)
    {
        $this->copiaCorreo = $copiaCorreo;

        return $this;
    }

    /**
     * Get copiaCorreo
     *
     * @return string
     */
    public function getCopiaCorreo()
    {
        return $this->copiaCorreo;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCorreoSaia
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
