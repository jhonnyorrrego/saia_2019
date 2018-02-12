<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaCompras
 *
 * @ORM\Table(name="ft_prueba_compras", indexes={@ORM\Index(name="i_prueba_compras_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_prueba_compras_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPruebaCompras
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_compras", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaCompras;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="remitente", type="string", length=255, nullable=true)
     */
    private $remitente;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_compra", type="string", length=255, nullable=false)
     */
    private $tipoCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="cuotas", type="string", length=255, nullable=true)
     */
    private $cuotas;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=255, nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;



    /**
     * Get idftPruebaCompras
     *
     * @return integer
     */
    public function getIdftPruebaCompras()
    {
        return $this->idftPruebaCompras;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaCompras
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
     * @return FtPruebaCompras
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
     * @return FtPruebaCompras
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
     * @return FtPruebaCompras
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
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return FtPruebaCompras
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set remitente
     *
     * @param string $remitente
     *
     * @return FtPruebaCompras
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;

        return $this;
    }

    /**
     * Get remitente
     *
     * @return string
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * Set tipoCompra
     *
     * @param string $tipoCompra
     *
     * @return FtPruebaCompras
     */
    public function setTipoCompra($tipoCompra)
    {
        $this->tipoCompra = $tipoCompra;

        return $this;
    }

    /**
     * Get tipoCompra
     *
     * @return string
     */
    public function getTipoCompra()
    {
        return $this->tipoCompra;
    }

    /**
     * Set cuotas
     *
     * @param string $cuotas
     *
     * @return FtPruebaCompras
     */
    public function setCuotas($cuotas)
    {
        $this->cuotas = $cuotas;

        return $this;
    }

    /**
     * Get cuotas
     *
     * @return string
     */
    public function getCuotas()
    {
        return $this->cuotas;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return FtPruebaCompras
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtPruebaCompras
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtPruebaCompras
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtPruebaCompras
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set funcionario
     *
     * @param string $funcionario
     *
     * @return FtPruebaCompras
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return string
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }
}
