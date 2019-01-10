<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salidas
 *
 * @ORM\Table(name="salidas", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Salidas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsalida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="numero_guia", type="string", length=255, nullable=true)
     */
    private $numeroGuia;

    /**
     * @var integer
     *
     * @ORM\Column(name="empresa", type="integer", nullable=true)
     */
    private $empresa = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_despacho", type="date", nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_despacho", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="radicado_despacho", type="integer", nullable=true)
     */
    private $radicadoDespacho;



    /**
     * Get idsalida
     *
     * @return integer
     */
    public function getIdsalida()
    {
        return $this->idsalida;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Salidas
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
     * Set numeroGuia
     *
     * @param string $numeroGuia
     *
     * @return Salidas
     */
    public function setNumeroGuia($numeroGuia)
    {
        $this->numeroGuia = $numeroGuia;

        return $this;
    }

    /**
     * Get numeroGuia
     *
     * @return string
     */
    public function getNumeroGuia()
    {
        return $this->numeroGuia;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     *
     * @return Salidas
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return integer
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set responsable
     *
     * @param integer $responsable
     *
     * @return Salidas
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return integer
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Salidas
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
     * Set fechaDespacho
     *
     * @param \DateTime $fechaDespacho
     *
     * @return Salidas
     */
    public function setFechaDespacho($fechaDespacho)
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }

    /**
     * Get fechaDespacho
     *
     * @return \DateTime
     */
    public function getFechaDespacho()
    {
        return $this->fechaDespacho;
    }

    /**
     * Set tipoDespacho
     *
     * @param string $tipoDespacho
     *
     * @return Salidas
     */
    public function setTipoDespacho($tipoDespacho)
    {
        $this->tipoDespacho = $tipoDespacho;

        return $this;
    }

    /**
     * Get tipoDespacho
     *
     * @return string
     */
    public function getTipoDespacho()
    {
        return $this->tipoDespacho;
    }

    /**
     * Set notas
     *
     * @param string $notas
     *
     * @return Salidas
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Salidas
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set radicadoDespacho
     *
     * @param integer $radicadoDespacho
     *
     * @return Salidas
     */
    public function setRadicadoDespacho($radicadoDespacho)
    {
        $this->radicadoDespacho = $radicadoDespacho;

        return $this;
    }

    /**
     * Get radicadoDespacho
     *
     * @return integer
     */
    public function getRadicadoDespacho()
    {
        return $this->radicadoDespacho;
    }
}
