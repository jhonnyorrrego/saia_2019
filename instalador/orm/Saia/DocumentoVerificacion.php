<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVerificacion
 *
 * @ORM\Table(name="documento_verificacion", indexes={@ORM\Index(name="i_documento_verificacion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoVerificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_verificacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoVerificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="verificacion", type="string", length=255, nullable=true)
     */
    private $verificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_qr", type="string", length=255, nullable=false)
     */
    private $rutaQr;



    /**
     * Get iddocumentoVerificacion
     *
     * @return integer
     */
    public function getIddocumentoVerificacion()
    {
        return $this->iddocumentoVerificacion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoVerificacion
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return DocumentoVerificacion
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DocumentoVerificacion
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
     * Set verificacion
     *
     * @param string $verificacion
     *
     * @return DocumentoVerificacion
     */
    public function setVerificacion($verificacion)
    {
        $this->verificacion = $verificacion;

        return $this;
    }

    /**
     * Get verificacion
     *
     * @return string
     */
    public function getVerificacion()
    {
        return $this->verificacion;
    }

    /**
     * Set rutaQr
     *
     * @param string $rutaQr
     *
     * @return DocumentoVerificacion
     */
    public function setRutaQr($rutaQr)
    {
        $this->rutaQr = $rutaQr;

        return $this;
    }

    /**
     * Get rutaQr
     *
     * @return string
     */
    public function getRutaQr()
    {
        return $this->rutaQr;
    }
}
