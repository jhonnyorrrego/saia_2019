<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="anexos", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Anexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo = 'BASE';

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=255, nullable=true)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_formato", type="string", length=255, nullable=true)
     */
    private $camposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idbinario", type="integer", nullable=true)
     */
    private $idbinario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anexo", type="datetime", nullable=true)
     */
    private $fechaAnexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;



    /**
     * Get idanexos
     *
     * @return integer
     */
    public function getIdanexos()
    {
        return $this->idanexos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Anexos
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
     * Set ruta
     *
     * @param string $ruta
     *
     * @return Anexos
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Anexos
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Anexos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set formato
     *
     * @param string $formato
     *
     * @return Anexos
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return string
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set camposFormato
     *
     * @param string $camposFormato
     *
     * @return Anexos
     */
    public function setCamposFormato($camposFormato)
    {
        $this->camposFormato = $camposFormato;

        return $this;
    }

    /**
     * Get camposFormato
     *
     * @return string
     */
    public function getCamposFormato()
    {
        return $this->camposFormato;
    }

    /**
     * Set idbinario
     *
     * @param integer $idbinario
     *
     * @return Anexos
     */
    public function setIdbinario($idbinario)
    {
        $this->idbinario = $idbinario;

        return $this;
    }

    /**
     * Get idbinario
     *
     * @return integer
     */
    public function getIdbinario()
    {
        return $this->idbinario;
    }

    /**
     * Set fechaAnexo
     *
     * @param \DateTime $fechaAnexo
     *
     * @return Anexos
     */
    public function setFechaAnexo($fechaAnexo)
    {
        $this->fechaAnexo = $fechaAnexo;

        return $this;
    }

    /**
     * Get fechaAnexo
     *
     * @return \DateTime
     */
    public function getFechaAnexo()
    {
        return $this->fechaAnexo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Anexos
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
}
