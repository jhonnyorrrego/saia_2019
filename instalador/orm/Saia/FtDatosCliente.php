<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDatosCliente
 *
 * @ORM\Table(name="ft_datos_cliente", indexes={@ORM\Index(name="i_ft_datos_cliente_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDatosCliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_datos_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftDatosCliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '935';

    /**
     * @var string
     *
     * @ORM\Column(name="datos_cliente", type="string", length=255, nullable=false)
     */
    private $datosCliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso_cliente", type="date", nullable=false)
     */
    private $fechaIngresoCliente;

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
     * @ORM\Column(name="observaciones_cliente", type="text", length=65535, nullable=true)
     */
    private $observacionesCliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftDatosCliente
     *
     * @return integer
     */
    public function getIdftDatosCliente()
    {
        return $this->idftDatosCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDatosCliente
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
     * Set datosCliente
     *
     * @param string $datosCliente
     *
     * @return FtDatosCliente
     */
    public function setDatosCliente($datosCliente)
    {
        $this->datosCliente = $datosCliente;

        return $this;
    }

    /**
     * Get datosCliente
     *
     * @return string
     */
    public function getDatosCliente()
    {
        return $this->datosCliente;
    }

    /**
     * Set fechaIngresoCliente
     *
     * @param \DateTime $fechaIngresoCliente
     *
     * @return FtDatosCliente
     */
    public function setFechaIngresoCliente($fechaIngresoCliente)
    {
        $this->fechaIngresoCliente = $fechaIngresoCliente;

        return $this;
    }

    /**
     * Get fechaIngresoCliente
     *
     * @return \DateTime
     */
    public function getFechaIngresoCliente()
    {
        return $this->fechaIngresoCliente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * Set observacionesCliente
     *
     * @param string $observacionesCliente
     *
     * @return FtDatosCliente
     */
    public function setObservacionesCliente($observacionesCliente)
    {
        $this->observacionesCliente = $observacionesCliente;

        return $this;
    }

    /**
     * Get observacionesCliente
     *
     * @return string
     */
    public function getObservacionesCliente()
    {
        return $this->observacionesCliente;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDatosCliente
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
