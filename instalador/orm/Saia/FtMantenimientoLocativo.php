<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMantenimientoLocativo
 *
 * @ORM\Table(name="ft_mantenimiento_locativo", indexes={@ORM\Index(name="i_ft_mantenimiento_locativo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtMantenimientoLocativo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_mantenimiento_locativo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftMantenimientoLocativo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1006';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaboracion", type="date", nullable=false)
     */
    private $fechaElaboracion;

    /**
     * @var string
     *
     * @ORM\Column(name="describe_requerimiento", type="text", length=65535, nullable=false)
     */
    private $describeRequerimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="date", nullable=true)
     */
    private $fechaSolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=true)
     */
    private $prioridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="soportes_anexos", type="integer", nullable=true)
     */
    private $soportesAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="jefe_area", type="string", length=255, nullable=false)
     */
    private $jefeArea;

    /**
     * @var string
     *
     * @ORM\Column(name="aprovacion_logistica", type="string", length=255, nullable=false)
     */
    private $aprovacionLogistica;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_que_solita", type="string", length=255, nullable=false)
     */
    private $usuarioQueSolita;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=false)
     */
    private $area;

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
     * Get idftMantenimientoLocativo
     *
     * @return integer
     */
    public function getIdftMantenimientoLocativo()
    {
        return $this->idftMantenimientoLocativo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtMantenimientoLocativo
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
     * Set fechaElaboracion
     *
     * @param \DateTime $fechaElaboracion
     *
     * @return FtMantenimientoLocativo
     */
    public function setFechaElaboracion($fechaElaboracion)
    {
        $this->fechaElaboracion = $fechaElaboracion;

        return $this;
    }

    /**
     * Get fechaElaboracion
     *
     * @return \DateTime
     */
    public function getFechaElaboracion()
    {
        return $this->fechaElaboracion;
    }

    /**
     * Set describeRequerimiento
     *
     * @param string $describeRequerimiento
     *
     * @return FtMantenimientoLocativo
     */
    public function setDescribeRequerimiento($describeRequerimiento)
    {
        $this->describeRequerimiento = $describeRequerimiento;

        return $this;
    }

    /**
     * Get describeRequerimiento
     *
     * @return string
     */
    public function getDescribeRequerimiento()
    {
        return $this->describeRequerimiento;
    }

    /**
     * Set fechaSolucion
     *
     * @param \DateTime $fechaSolucion
     *
     * @return FtMantenimientoLocativo
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    /**
     * Get fechaSolucion
     *
     * @return \DateTime
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return FtMantenimientoLocativo
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set soportesAnexos
     *
     * @param integer $soportesAnexos
     *
     * @return FtMantenimientoLocativo
     */
    public function setSoportesAnexos($soportesAnexos)
    {
        $this->soportesAnexos = $soportesAnexos;

        return $this;
    }

    /**
     * Get soportesAnexos
     *
     * @return integer
     */
    public function getSoportesAnexos()
    {
        return $this->soportesAnexos;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtMantenimientoLocativo
     */
    public function setAnexosDigitales($anexosDigitales)
    {
        $this->anexosDigitales = $anexosDigitales;

        return $this;
    }

    /**
     * Get anexosDigitales
     *
     * @return string
     */
    public function getAnexosDigitales()
    {
        return $this->anexosDigitales;
    }

    /**
     * Set jefeArea
     *
     * @param string $jefeArea
     *
     * @return FtMantenimientoLocativo
     */
    public function setJefeArea($jefeArea)
    {
        $this->jefeArea = $jefeArea;

        return $this;
    }

    /**
     * Get jefeArea
     *
     * @return string
     */
    public function getJefeArea()
    {
        return $this->jefeArea;
    }

    /**
     * Set aprovacionLogistica
     *
     * @param string $aprovacionLogistica
     *
     * @return FtMantenimientoLocativo
     */
    public function setAprovacionLogistica($aprovacionLogistica)
    {
        $this->aprovacionLogistica = $aprovacionLogistica;

        return $this;
    }

    /**
     * Get aprovacionLogistica
     *
     * @return string
     */
    public function getAprovacionLogistica()
    {
        return $this->aprovacionLogistica;
    }

    /**
     * Set usuarioQueSolita
     *
     * @param string $usuarioQueSolita
     *
     * @return FtMantenimientoLocativo
     */
    public function setUsuarioQueSolita($usuarioQueSolita)
    {
        $this->usuarioQueSolita = $usuarioQueSolita;

        return $this;
    }

    /**
     * Get usuarioQueSolita
     *
     * @return string
     */
    public function getUsuarioQueSolita()
    {
        return $this->usuarioQueSolita;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return FtMantenimientoLocativo
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtMantenimientoLocativo
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
     * @return FtMantenimientoLocativo
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
     * @return FtMantenimientoLocativo
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
     * @return FtMantenimientoLocativo
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
     * @return FtMantenimientoLocativo
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
