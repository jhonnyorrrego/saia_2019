<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSoporte
 *
 * @ORM\Table(name="ft_soporte")
 * @ORM\Entity
 */
class FtSoporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_soporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '902';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_soporte", type="date", nullable=false)
     */
    private $fechaSoporte;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="activos", type="string", length=255, nullable=false)
     */
    private $activos;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="integer", nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

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
     * Get idftSoporte
     *
     * @return integer
     */
    public function getIdftSoporte()
    {
        return $this->idftSoporte;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSoporte
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
     * Set fechaSoporte
     *
     * @param \DateTime $fechaSoporte
     *
     * @return FtSoporte
     */
    public function setFechaSoporte($fechaSoporte)
    {
        $this->fechaSoporte = $fechaSoporte;

        return $this;
    }

    /**
     * Get fechaSoporte
     *
     * @return \DateTime
     */
    public function getFechaSoporte()
    {
        return $this->fechaSoporte;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtSoporte
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set activos
     *
     * @param string $activos
     *
     * @return FtSoporte
     */
    public function setActivos($activos)
    {
        $this->activos = $activos;

        return $this;
    }

    /**
     * Get activos
     *
     * @return string
     */
    public function getActivos()
    {
        return $this->activos;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return FtSoporte
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
     * Set categoria
     *
     * @param integer $categoria
     *
     * @return FtSoporte
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtSoporte
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
     * Set anexo
     *
     * @param string $anexo
     *
     * @return FtSoporte
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSoporte
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
     * @return FtSoporte
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
     * @return FtSoporte
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
     * @return FtSoporte
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
     * @return FtSoporte
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
