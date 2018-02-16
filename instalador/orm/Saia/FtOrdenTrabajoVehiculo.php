<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOrdenTrabajoVehiculo
 *
 * @ORM\Table(name="ft_orden_trabajo_vehiculo", indexes={@ORM\Index(name="i_ft_orden_trabajo_vehiculo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtOrdenTrabajoVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_orden_trabajo_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftOrdenTrabajoVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_confir_negoci_vehiculo", type="integer", nullable=false)
     */
    private $ftConfirNegociVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '951';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_orden_trabajo", type="date", nullable=false)
     */
    private $fechaOrdenTrabajo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compromiso", type="date", nullable=false)
     */
    private $fechaCompromiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad_servicio", type="integer", nullable=false)
     */
    private $prioridadServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_solicitante", type="string", length=255, nullable=false)
     */
    private $nombreSolicitante;

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
     * @ORM\Column(name="nombre_asegurador", type="string", length=255, nullable=false)
     */
    private $nombreAsegurador;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_servicio", type="text", length=65535, nullable=false)
     */
    private $motivoServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_servicio", type="integer", nullable=false)
     */
    private $tipoServicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud_orden", type="date", nullable=false)
     */
    private $fechaSolicitudOrden;

    /**
     * @var string
     *
     * @ORM\Column(name="llamadas_requeridas", type="text", length=65535, nullable=true)
     */
    private $llamadasRequeridas;

    /**
     * @var integer
     *
     * @ORM\Column(name="kilometros_vehiculo", type="integer", nullable=false)
     */
    private $kilometrosVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_servicio", type="string", length=255, nullable=true)
     */
    private $campoServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="ctto_numero", type="string", length=255, nullable=true)
     */
    private $cttoNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_recibo", type="string", length=255, nullable=true)
     */
    private $funcionarioRecibo;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa_cliente", type="string", length=255, nullable=true)
     */
    private $firmaExternaCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa_satisfaccion", type="string", length=255, nullable=true)
     */
    private $firmaExternaSatisfaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftOrdenTrabajoVehiculo
     *
     * @return integer
     */
    public function getIdftOrdenTrabajoVehiculo()
    {
        return $this->idftOrdenTrabajoVehiculo;
    }

    /**
     * Set ftConfirNegociVehiculo
     *
     * @param integer $ftConfirNegociVehiculo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFtConfirNegociVehiculo($ftConfirNegociVehiculo)
    {
        $this->ftConfirNegociVehiculo = $ftConfirNegociVehiculo;

        return $this;
    }

    /**
     * Get ftConfirNegociVehiculo
     *
     * @return integer
     */
    public function getFtConfirNegociVehiculo()
    {
        return $this->ftConfirNegociVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenTrabajoVehiculo
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
     * Set fechaOrdenTrabajo
     *
     * @param \DateTime $fechaOrdenTrabajo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaOrdenTrabajo($fechaOrdenTrabajo)
    {
        $this->fechaOrdenTrabajo = $fechaOrdenTrabajo;

        return $this;
    }

    /**
     * Get fechaOrdenTrabajo
     *
     * @return \DateTime
     */
    public function getFechaOrdenTrabajo()
    {
        return $this->fechaOrdenTrabajo;
    }

    /**
     * Set fechaCompromiso
     *
     * @param \DateTime $fechaCompromiso
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaCompromiso($fechaCompromiso)
    {
        $this->fechaCompromiso = $fechaCompromiso;

        return $this;
    }

    /**
     * Get fechaCompromiso
     *
     * @return \DateTime
     */
    public function getFechaCompromiso()
    {
        return $this->fechaCompromiso;
    }

    /**
     * Set prioridadServicio
     *
     * @param integer $prioridadServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setPrioridadServicio($prioridadServicio)
    {
        $this->prioridadServicio = $prioridadServicio;

        return $this;
    }

    /**
     * Get prioridadServicio
     *
     * @return integer
     */
    public function getPrioridadServicio()
    {
        return $this->prioridadServicio;
    }

    /**
     * Set nombreSolicitante
     *
     * @param string $nombreSolicitante
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setNombreSolicitante($nombreSolicitante)
    {
        $this->nombreSolicitante = $nombreSolicitante;

        return $this;
    }

    /**
     * Get nombreSolicitante
     *
     * @return string
     */
    public function getNombreSolicitante()
    {
        return $this->nombreSolicitante;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * Set nombreAsegurador
     *
     * @param string $nombreAsegurador
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setNombreAsegurador($nombreAsegurador)
    {
        $this->nombreAsegurador = $nombreAsegurador;

        return $this;
    }

    /**
     * Get nombreAsegurador
     *
     * @return string
     */
    public function getNombreAsegurador()
    {
        return $this->nombreAsegurador;
    }

    /**
     * Set motivoServicio
     *
     * @param string $motivoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setMotivoServicio($motivoServicio)
    {
        $this->motivoServicio = $motivoServicio;

        return $this;
    }

    /**
     * Get motivoServicio
     *
     * @return string
     */
    public function getMotivoServicio()
    {
        return $this->motivoServicio;
    }

    /**
     * Set tipoServicio
     *
     * @param integer $tipoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }

    /**
     * Get tipoServicio
     *
     * @return integer
     */
    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    /**
     * Set fechaSolicitudOrden
     *
     * @param \DateTime $fechaSolicitudOrden
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaSolicitudOrden($fechaSolicitudOrden)
    {
        $this->fechaSolicitudOrden = $fechaSolicitudOrden;

        return $this;
    }

    /**
     * Get fechaSolicitudOrden
     *
     * @return \DateTime
     */
    public function getFechaSolicitudOrden()
    {
        return $this->fechaSolicitudOrden;
    }

    /**
     * Set llamadasRequeridas
     *
     * @param string $llamadasRequeridas
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setLlamadasRequeridas($llamadasRequeridas)
    {
        $this->llamadasRequeridas = $llamadasRequeridas;

        return $this;
    }

    /**
     * Get llamadasRequeridas
     *
     * @return string
     */
    public function getLlamadasRequeridas()
    {
        return $this->llamadasRequeridas;
    }

    /**
     * Set kilometrosVehiculo
     *
     * @param integer $kilometrosVehiculo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setKilometrosVehiculo($kilometrosVehiculo)
    {
        $this->kilometrosVehiculo = $kilometrosVehiculo;

        return $this;
    }

    /**
     * Get kilometrosVehiculo
     *
     * @return integer
     */
    public function getKilometrosVehiculo()
    {
        return $this->kilometrosVehiculo;
    }

    /**
     * Set campoServicio
     *
     * @param string $campoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setCampoServicio($campoServicio)
    {
        $this->campoServicio = $campoServicio;

        return $this;
    }

    /**
     * Get campoServicio
     *
     * @return string
     */
    public function getCampoServicio()
    {
        return $this->campoServicio;
    }

    /**
     * Set cttoNumero
     *
     * @param string $cttoNumero
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setCttoNumero($cttoNumero)
    {
        $this->cttoNumero = $cttoNumero;

        return $this;
    }

    /**
     * Get cttoNumero
     *
     * @return string
     */
    public function getCttoNumero()
    {
        return $this->cttoNumero;
    }

    /**
     * Set funcionarioRecibo
     *
     * @param string $funcionarioRecibo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFuncionarioRecibo($funcionarioRecibo)
    {
        $this->funcionarioRecibo = $funcionarioRecibo;

        return $this;
    }

    /**
     * Get funcionarioRecibo
     *
     * @return string
     */
    public function getFuncionarioRecibo()
    {
        return $this->funcionarioRecibo;
    }

    /**
     * Set firmaExternaCliente
     *
     * @param string $firmaExternaCliente
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFirmaExternaCliente($firmaExternaCliente)
    {
        $this->firmaExternaCliente = $firmaExternaCliente;

        return $this;
    }

    /**
     * Get firmaExternaCliente
     *
     * @return string
     */
    public function getFirmaExternaCliente()
    {
        return $this->firmaExternaCliente;
    }

    /**
     * Set firmaExternaSatisfaccion
     *
     * @param string $firmaExternaSatisfaccion
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFirmaExternaSatisfaccion($firmaExternaSatisfaccion)
    {
        $this->firmaExternaSatisfaccion = $firmaExternaSatisfaccion;

        return $this;
    }

    /**
     * Get firmaExternaSatisfaccion
     *
     * @return string
     */
    public function getFirmaExternaSatisfaccion()
    {
        return $this->firmaExternaSatisfaccion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtOrdenTrabajoVehiculo
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
