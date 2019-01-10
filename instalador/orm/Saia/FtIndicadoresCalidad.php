<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIndicadoresCalidad
 *
 * @ORM\Table(name="ft_indicadores_calidad", indexes={@ORM\Index(name="i_ft_indicadores_calidad_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_indicadores_calidad_proceso", columns={"ft_proceso"}), @ORM\Index(name="i_indicadores_calidad_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtIndicadoresCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_indicadores_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftIndicadoresCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2541';

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_analisis", type="string", length=255, nullable=false)
     */
    private $responsableAnalisis;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_grafico", type="string", length=20, nullable=false)
     */
    private $tipoGrafico = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="fuente_datos", type="text", length=65535, nullable=false)
     */
    private $fuenteDatos;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo_calidad_indicador", type="text", length=65535, nullable=false)
     */
    private $objetivoCalidadIndicador;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia_indicador", type="string", length=255, nullable=false)
     */
    private $dependenciaIndicador;

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
     * Get idftIndicadoresCalidad
     *
     * @return integer
     */
    public function getIdftIndicadoresCalidad()
    {
        return $this->idftIndicadoresCalidad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtIndicadoresCalidad
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtIndicadoresCalidad
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtIndicadoresCalidad
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
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtIndicadoresCalidad
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtIndicadoresCalidad
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
     * Set responsableAnalisis
     *
     * @param string $responsableAnalisis
     *
     * @return FtIndicadoresCalidad
     */
    public function setResponsableAnalisis($responsableAnalisis)
    {
        $this->responsableAnalisis = $responsableAnalisis;

        return $this;
    }

    /**
     * Get responsableAnalisis
     *
     * @return string
     */
    public function getResponsableAnalisis()
    {
        return $this->responsableAnalisis;
    }

    /**
     * Set tipoGrafico
     *
     * @param string $tipoGrafico
     *
     * @return FtIndicadoresCalidad
     */
    public function setTipoGrafico($tipoGrafico)
    {
        $this->tipoGrafico = $tipoGrafico;

        return $this;
    }

    /**
     * Get tipoGrafico
     *
     * @return string
     */
    public function getTipoGrafico()
    {
        return $this->tipoGrafico;
    }

    /**
     * Set fuenteDatos
     *
     * @param string $fuenteDatos
     *
     * @return FtIndicadoresCalidad
     */
    public function setFuenteDatos($fuenteDatos)
    {
        $this->fuenteDatos = $fuenteDatos;

        return $this;
    }

    /**
     * Get fuenteDatos
     *
     * @return string
     */
    public function getFuenteDatos()
    {
        return $this->fuenteDatos;
    }

    /**
     * Set objetivoCalidadIndicador
     *
     * @param string $objetivoCalidadIndicador
     *
     * @return FtIndicadoresCalidad
     */
    public function setObjetivoCalidadIndicador($objetivoCalidadIndicador)
    {
        $this->objetivoCalidadIndicador = $objetivoCalidadIndicador;

        return $this;
    }

    /**
     * Get objetivoCalidadIndicador
     *
     * @return string
     */
    public function getObjetivoCalidadIndicador()
    {
        return $this->objetivoCalidadIndicador;
    }

    /**
     * Set dependenciaIndicador
     *
     * @param string $dependenciaIndicador
     *
     * @return FtIndicadoresCalidad
     */
    public function setDependenciaIndicador($dependenciaIndicador)
    {
        $this->dependenciaIndicador = $dependenciaIndicador;

        return $this;
    }

    /**
     * Get dependenciaIndicador
     *
     * @return string
     */
    public function getDependenciaIndicador()
    {
        return $this->dependenciaIndicador;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtIndicadoresCalidad
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
     * @return FtIndicadoresCalidad
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtIndicadoresCalidad
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
     * @return FtIndicadoresCalidad
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
