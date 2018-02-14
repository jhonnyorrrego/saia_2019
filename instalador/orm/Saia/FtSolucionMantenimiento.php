<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolucionMantenimiento
 *
 * @ORM\Table(name="ft_solucion_mantenimiento")
 * @ORM\Entity
 */
class FtSolucionMantenimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solucion_mantenimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolucionMantenimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_mantenimiento_locativo", type="integer", nullable=false)
     */
    private $ftMantenimientoLocativo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1007';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_responsable", type="string", length=255, nullable=true)
     */
    private $nombreResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_solucion", type="text", length=65535, nullable=false)
     */
    private $descripcionSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="prerequisitos_montaje", type="text", length=65535, nullable=true)
     */
    private $prerequisitosMontaje;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_solucion", type="integer", nullable=true)
     */
    private $anexosSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="solucion_digital", type="string", length=255, nullable=true)
     */
    private $solucionDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="implementado_por", type="string", length=255, nullable=false)
     */
    private $implementadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobacion_logistica", type="string", length=255, nullable=false)
     */
    private $aprobacionLogistica;

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
     * Get idftSolucionMantenimiento
     *
     * @return integer
     */
    public function getIdftSolucionMantenimiento()
    {
        return $this->idftSolucionMantenimiento;
    }

    /**
     * Set ftMantenimientoLocativo
     *
     * @param integer $ftMantenimientoLocativo
     *
     * @return FtSolucionMantenimiento
     */
    public function setFtMantenimientoLocativo($ftMantenimientoLocativo)
    {
        $this->ftMantenimientoLocativo = $ftMantenimientoLocativo;

        return $this;
    }

    /**
     * Get ftMantenimientoLocativo
     *
     * @return integer
     */
    public function getFtMantenimientoLocativo()
    {
        return $this->ftMantenimientoLocativo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolucionMantenimiento
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtSolucionMantenimiento
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
     * Set nombreResponsable
     *
     * @param string $nombreResponsable
     *
     * @return FtSolucionMantenimiento
     */
    public function setNombreResponsable($nombreResponsable)
    {
        $this->nombreResponsable = $nombreResponsable;

        return $this;
    }

    /**
     * Get nombreResponsable
     *
     * @return string
     */
    public function getNombreResponsable()
    {
        return $this->nombreResponsable;
    }

    /**
     * Set descripcionSolucion
     *
     * @param string $descripcionSolucion
     *
     * @return FtSolucionMantenimiento
     */
    public function setDescripcionSolucion($descripcionSolucion)
    {
        $this->descripcionSolucion = $descripcionSolucion;

        return $this;
    }

    /**
     * Get descripcionSolucion
     *
     * @return string
     */
    public function getDescripcionSolucion()
    {
        return $this->descripcionSolucion;
    }

    /**
     * Set prerequisitosMontaje
     *
     * @param string $prerequisitosMontaje
     *
     * @return FtSolucionMantenimiento
     */
    public function setPrerequisitosMontaje($prerequisitosMontaje)
    {
        $this->prerequisitosMontaje = $prerequisitosMontaje;

        return $this;
    }

    /**
     * Get prerequisitosMontaje
     *
     * @return string
     */
    public function getPrerequisitosMontaje()
    {
        return $this->prerequisitosMontaje;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSolucionMantenimiento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set anexosSolucion
     *
     * @param integer $anexosSolucion
     *
     * @return FtSolucionMantenimiento
     */
    public function setAnexosSolucion($anexosSolucion)
    {
        $this->anexosSolucion = $anexosSolucion;

        return $this;
    }

    /**
     * Get anexosSolucion
     *
     * @return integer
     */
    public function getAnexosSolucion()
    {
        return $this->anexosSolucion;
    }

    /**
     * Set solucionDigital
     *
     * @param string $solucionDigital
     *
     * @return FtSolucionMantenimiento
     */
    public function setSolucionDigital($solucionDigital)
    {
        $this->solucionDigital = $solucionDigital;

        return $this;
    }

    /**
     * Get solucionDigital
     *
     * @return string
     */
    public function getSolucionDigital()
    {
        return $this->solucionDigital;
    }

    /**
     * Set implementadoPor
     *
     * @param string $implementadoPor
     *
     * @return FtSolucionMantenimiento
     */
    public function setImplementadoPor($implementadoPor)
    {
        $this->implementadoPor = $implementadoPor;

        return $this;
    }

    /**
     * Get implementadoPor
     *
     * @return string
     */
    public function getImplementadoPor()
    {
        return $this->implementadoPor;
    }

    /**
     * Set aprobacionLogistica
     *
     * @param string $aprobacionLogistica
     *
     * @return FtSolucionMantenimiento
     */
    public function setAprobacionLogistica($aprobacionLogistica)
    {
        $this->aprobacionLogistica = $aprobacionLogistica;

        return $this;
    }

    /**
     * Get aprobacionLogistica
     *
     * @return string
     */
    public function getAprobacionLogistica()
    {
        return $this->aprobacionLogistica;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
