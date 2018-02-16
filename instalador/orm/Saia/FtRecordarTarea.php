<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRecordarTarea
 *
 * @ORM\Table(name="ft_recordar_tarea")
 * @ORM\Entity
 */
class FtRecordarTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_recordar_tarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftRecordarTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '908';

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=true)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="vinculados", type="string", length=255, nullable=false)
     */
    private $vinculados;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea_asiganda", type="string", length=255, nullable=false)
     */
    private $tareaAsiganda;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicidad", type="string", length=255, nullable=false)
     */
    private $periodicidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entraga", type="date", nullable=false)
     */
    private $fechaEntraga;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="dias_recordar", type="string", length=255, nullable=true)
     */
    private $diasRecordar;

    /**
     * @var string
     *
     * @ORM\Column(name="horas_recordar", type="string", length=255, nullable=true)
     */
    private $horasRecordar;

    /**
     * @var string
     *
     * @ORM\Column(name="mes_recordar", type="string", length=255, nullable=true)
     */
    private $mesRecordar;

    /**
     * @var string
     *
     * @ORM\Column(name="semanas_recordar", type="string", length=255, nullable=true)
     */
    private $semanasRecordar;

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
     * @ORM\Column(name="tipo_periodo", type="integer", nullable=true)
     */
    private $tipoPeriodo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_formato", type="date", nullable=false)
     */
    private $fechaFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftRecordarTarea
     *
     * @return integer
     */
    public function getIdftRecordarTarea()
    {
        return $this->idftRecordarTarea;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRecordarTarea
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtRecordarTarea
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
     * Set vinculados
     *
     * @param string $vinculados
     *
     * @return FtRecordarTarea
     */
    public function setVinculados($vinculados)
    {
        $this->vinculados = $vinculados;

        return $this;
    }

    /**
     * Get vinculados
     *
     * @return string
     */
    public function getVinculados()
    {
        return $this->vinculados;
    }

    /**
     * Set tareaAsiganda
     *
     * @param string $tareaAsiganda
     *
     * @return FtRecordarTarea
     */
    public function setTareaAsiganda($tareaAsiganda)
    {
        $this->tareaAsiganda = $tareaAsiganda;

        return $this;
    }

    /**
     * Get tareaAsiganda
     *
     * @return string
     */
    public function getTareaAsiganda()
    {
        return $this->tareaAsiganda;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return FtRecordarTarea
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtRecordarTarea
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
     * Set periodicidad
     *
     * @param string $periodicidad
     *
     * @return FtRecordarTarea
     */
    public function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;

        return $this;
    }

    /**
     * Get periodicidad
     *
     * @return string
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * Set fechaEntraga
     *
     * @param \DateTime $fechaEntraga
     *
     * @return FtRecordarTarea
     */
    public function setFechaEntraga($fechaEntraga)
    {
        $this->fechaEntraga = $fechaEntraga;

        return $this;
    }

    /**
     * Get fechaEntraga
     *
     * @return \DateTime
     */
    public function getFechaEntraga()
    {
        return $this->fechaEntraga;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtRecordarTarea
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
     * Set diasRecordar
     *
     * @param string $diasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setDiasRecordar($diasRecordar)
    {
        $this->diasRecordar = $diasRecordar;

        return $this;
    }

    /**
     * Get diasRecordar
     *
     * @return string
     */
    public function getDiasRecordar()
    {
        return $this->diasRecordar;
    }

    /**
     * Set horasRecordar
     *
     * @param string $horasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setHorasRecordar($horasRecordar)
    {
        $this->horasRecordar = $horasRecordar;

        return $this;
    }

    /**
     * Get horasRecordar
     *
     * @return string
     */
    public function getHorasRecordar()
    {
        return $this->horasRecordar;
    }

    /**
     * Set mesRecordar
     *
     * @param string $mesRecordar
     *
     * @return FtRecordarTarea
     */
    public function setMesRecordar($mesRecordar)
    {
        $this->mesRecordar = $mesRecordar;

        return $this;
    }

    /**
     * Get mesRecordar
     *
     * @return string
     */
    public function getMesRecordar()
    {
        return $this->mesRecordar;
    }

    /**
     * Set semanasRecordar
     *
     * @param string $semanasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setSemanasRecordar($semanasRecordar)
    {
        $this->semanasRecordar = $semanasRecordar;

        return $this;
    }

    /**
     * Get semanasRecordar
     *
     * @return string
     */
    public function getSemanasRecordar()
    {
        return $this->semanasRecordar;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * Set tipoPeriodo
     *
     * @param integer $tipoPeriodo
     *
     * @return FtRecordarTarea
     */
    public function setTipoPeriodo($tipoPeriodo)
    {
        $this->tipoPeriodo = $tipoPeriodo;

        return $this;
    }

    /**
     * Get tipoPeriodo
     *
     * @return integer
     */
    public function getTipoPeriodo()
    {
        return $this->tipoPeriodo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtRecordarTarea
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
     * Set fechaFormato
     *
     * @param \DateTime $fechaFormato
     *
     * @return FtRecordarTarea
     */
    public function setFechaFormato($fechaFormato)
    {
        $this->fechaFormato = $fechaFormato;

        return $this;
    }

    /**
     * Get fechaFormato
     *
     * @return \DateTime
     */
    public function getFechaFormato()
    {
        return $this->fechaFormato;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRecordarTarea
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
