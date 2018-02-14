<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRespuestaPqrsf
 *
 * @ORM\Table(name="ft_respuesta_pqrsf")
 * @ORM\Entity
 */
class FtRespuestaPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_respuesta_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRespuestaPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1036';

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", length=65535, nullable=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="para", type="string", length=255, nullable=false)
     */
    private $para;

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
     * @var integer
     *
     * @ORM\Column(name="requiere_recogida", type="integer", nullable=true)
     */
    private $requiereRecogida = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=true)
     */
    private $tipoMensajeria = '1';



    /**
     * Get idftRespuestaPqrsf
     *
     * @return integer
     */
    public function getIdftRespuestaPqrsf()
    {
        return $this->idftRespuestaPqrsf;
    }

    /**
     * Set ftPqrsf
     *
     * @param integer $ftPqrsf
     *
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return FtRespuestaPqrsf
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
     * Set para
     *
     * @param string $para
     *
     * @return FtRespuestaPqrsf
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * @return FtRespuestaPqrsf
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
     * Set requiereRecogida
     *
     * @param integer $requiereRecogida
     *
     * @return FtRespuestaPqrsf
     */
    public function setRequiereRecogida($requiereRecogida)
    {
        $this->requiereRecogida = $requiereRecogida;

        return $this;
    }

    /**
     * Get requiereRecogida
     *
     * @return integer
     */
    public function getRequiereRecogida()
    {
        return $this->requiereRecogida;
    }

    /**
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtRespuestaPqrsf
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
}
