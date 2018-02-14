<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtProcedimiento
 *
 * @ORM\Table(name="ft_procedimiento")
 * @ORM\Entity
 */
class FtProcedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_procedimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftProcedimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1040';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nomina", type="date", nullable=false)
     */
    private $fechaNomina;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="alcance", type="text", length=65535, nullable=false)
     */
    private $alcance;

    /**
     * @var string
     *
     * @ORM\Column(name="definicion", type="text", length=65535, nullable=false)
     */
    private $definicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="dispocisiones_generales", type="text", length=65535, nullable=true)
     */
    private $dispocisionesGenerales;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="acta", type="string", length=255, nullable=true)
     */
    private $acta;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado_por", type="string", length=255, nullable=true)
     */
    private $aprobadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftProcedimiento
     *
     * @return integer
     */
    public function getIdftProcedimiento()
    {
        return $this->idftProcedimiento;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtProcedimiento
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
     * @return FtProcedimiento
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtProcedimiento
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtProcedimiento
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
     * Set fechaNomina
     *
     * @param \DateTime $fechaNomina
     *
     * @return FtProcedimiento
     */
    public function setFechaNomina($fechaNomina)
    {
        $this->fechaNomina = $fechaNomina;

        return $this;
    }

    /**
     * Get fechaNomina
     *
     * @return \DateTime
     */
    public function getFechaNomina()
    {
        return $this->fechaNomina;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtProcedimiento
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtProcedimiento
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return FtProcedimiento
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtProcedimiento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtProcedimiento
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
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return FtProcedimiento
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set alcance
     *
     * @param string $alcance
     *
     * @return FtProcedimiento
     */
    public function setAlcance($alcance)
    {
        $this->alcance = $alcance;

        return $this;
    }

    /**
     * Get alcance
     *
     * @return string
     */
    public function getAlcance()
    {
        return $this->alcance;
    }

    /**
     * Set definicion
     *
     * @param string $definicion
     *
     * @return FtProcedimiento
     */
    public function setDefinicion($definicion)
    {
        $this->definicion = $definicion;

        return $this;
    }

    /**
     * Get definicion
     *
     * @return string
     */
    public function getDefinicion()
    {
        return $this->definicion;
    }

    /**
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtProcedimiento
     */
    public function setFtProceso($ftProceso)
    {
        $this->ftProceso = $ftProceso;

        return $this;
    }

    /**
     * Get ftProceso
     *
     * @return integer
     */
    public function getFtProceso()
    {
        return $this->ftProceso;
    }

    /**
     * Set dispocisionesGenerales
     *
     * @param string $dispocisionesGenerales
     *
     * @return FtProcedimiento
     */
    public function setDispocisionesGenerales($dispocisionesGenerales)
    {
        $this->dispocisionesGenerales = $dispocisionesGenerales;

        return $this;
    }

    /**
     * Get dispocisionesGenerales
     *
     * @return string
     */
    public function getDispocisionesGenerales()
    {
        return $this->dispocisionesGenerales;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtProcedimiento
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
     * Set acta
     *
     * @param string $acta
     *
     * @return FtProcedimiento
     */
    public function setActa($acta)
    {
        $this->acta = $acta;

        return $this;
    }

    /**
     * Get acta
     *
     * @return string
     */
    public function getActa()
    {
        return $this->acta;
    }

    /**
     * Set aprobadoPor
     *
     * @param string $aprobadoPor
     *
     * @return FtProcedimiento
     */
    public function setAprobadoPor($aprobadoPor)
    {
        $this->aprobadoPor = $aprobadoPor;

        return $this;
    }

    /**
     * Get aprobadoPor
     *
     * @return string
     */
    public function getAprobadoPor()
    {
        return $this->aprobadoPor;
    }

    /**
     * Set secretarias
     *
     * @param string $secretarias
     *
     * @return FtProcedimiento
     */
    public function setSecretarias($secretarias)
    {
        $this->secretarias = $secretarias;

        return $this;
    }

    /**
     * Get secretarias
     *
     * @return string
     */
    public function getSecretarias()
    {
        return $this->secretarias;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtProcedimiento
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
