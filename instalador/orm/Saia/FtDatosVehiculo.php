<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDatosVehiculo
 *
 * @ORM\Table(name="ft_datos_vehiculo", indexes={@ORM\Index(name="i_ft_datos_vehiculo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_datos_vehiculo_serie_chas", columns={"serie_chasis_vehiculo"}), @ORM\Index(name="i_datos_vehiculo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtDatosVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_datos_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDatosVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '936';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_vehiculo", type="string", length=255, nullable=false)
     */
    private $nombreVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="modelo_vehiculo", type="integer", nullable=false)
     */
    private $modeloVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="color_vehiculo", type="string", length=255, nullable=false)
     */
    private $colorVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="serie_chasis_vehiculo", type="string", length=255, nullable=false)
     */
    private $serieChasisVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_vehiculo", type="integer", nullable=false)
     */
    private $valorVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen_vehiculo", type="string", length=255, nullable=true)
     */
    private $imagenVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="motor_vehiculo", type="string", length=255, nullable=false)
     */
    private $motorVehiculo;

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
     * Get idftDatosVehiculo
     *
     * @return integer
     */
    public function getIdftDatosVehiculo()
    {
        return $this->idftDatosVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDatosVehiculo
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
     * Set nombreVehiculo
     *
     * @param string $nombreVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setNombreVehiculo($nombreVehiculo)
    {
        $this->nombreVehiculo = $nombreVehiculo;

        return $this;
    }

    /**
     * Get nombreVehiculo
     *
     * @return string
     */
    public function getNombreVehiculo()
    {
        return $this->nombreVehiculo;
    }

    /**
     * Set modeloVehiculo
     *
     * @param integer $modeloVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setModeloVehiculo($modeloVehiculo)
    {
        $this->modeloVehiculo = $modeloVehiculo;

        return $this;
    }

    /**
     * Get modeloVehiculo
     *
     * @return integer
     */
    public function getModeloVehiculo()
    {
        return $this->modeloVehiculo;
    }

    /**
     * Set colorVehiculo
     *
     * @param string $colorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setColorVehiculo($colorVehiculo)
    {
        $this->colorVehiculo = $colorVehiculo;

        return $this;
    }

    /**
     * Get colorVehiculo
     *
     * @return string
     */
    public function getColorVehiculo()
    {
        return $this->colorVehiculo;
    }

    /**
     * Set serieChasisVehiculo
     *
     * @param string $serieChasisVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setSerieChasisVehiculo($serieChasisVehiculo)
    {
        $this->serieChasisVehiculo = $serieChasisVehiculo;

        return $this;
    }

    /**
     * Get serieChasisVehiculo
     *
     * @return string
     */
    public function getSerieChasisVehiculo()
    {
        return $this->serieChasisVehiculo;
    }

    /**
     * Set valorVehiculo
     *
     * @param integer $valorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setValorVehiculo($valorVehiculo)
    {
        $this->valorVehiculo = $valorVehiculo;

        return $this;
    }

    /**
     * Get valorVehiculo
     *
     * @return integer
     */
    public function getValorVehiculo()
    {
        return $this->valorVehiculo;
    }

    /**
     * Set imagenVehiculo
     *
     * @param string $imagenVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setImagenVehiculo($imagenVehiculo)
    {
        $this->imagenVehiculo = $imagenVehiculo;

        return $this;
    }

    /**
     * Get imagenVehiculo
     *
     * @return string
     */
    public function getImagenVehiculo()
    {
        return $this->imagenVehiculo;
    }

    /**
     * Set motorVehiculo
     *
     * @param string $motorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setMotorVehiculo($motorVehiculo)
    {
        $this->motorVehiculo = $motorVehiculo;

        return $this;
    }

    /**
     * Get motorVehiculo
     *
     * @return string
     */
    public function getMotorVehiculo()
    {
        return $this->motorVehiculo;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
