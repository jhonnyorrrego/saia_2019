<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionSalida
 *
 * @ORM\Table(name="ft_radicacion_salida")
 * @ORM\Entity
 */
class FtRadicacionSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_salida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftRadicacionSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1318';

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_fisicos", type="integer", nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural", type="string", length=255, nullable=false)
     */
    private $personaNatural;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_salida", type="text", length=65535, nullable=false)
     */
    private $descripcionSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexos", type="string", length=255, nullable=true)
     */
    private $descripcionAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_radicado", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicacion_entrada", type="datetime", nullable=false)
     */
    private $fechaRadicacionEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_radicado", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="area_responsable", type="string", length=255, nullable=false)
     */
    private $areaResponsable;

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
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=false)
     */
    private $tipoMensajeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajeros", type="integer", nullable=true)
     */
    private $mensajeros;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_folios", type="integer", nullable=false)
     */
    private $numFolios;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftRadicacionSalida
     *
     * @return integer
     */
    public function getIdftRadicacionSalida()
    {
        return $this->idftRadicacionSalida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRadicacionSalida
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
     * Set anexosFisicos
     *
     * @param integer $anexosFisicos
     *
     * @return FtRadicacionSalida
     */
    public function setAnexosFisicos($anexosFisicos)
    {
        $this->anexosFisicos = $anexosFisicos;

        return $this;
    }

    /**
     * Get anexosFisicos
     *
     * @return integer
     */
    public function getAnexosFisicos()
    {
        return $this->anexosFisicos;
    }

    /**
     * Set personaNatural
     *
     * @param string $personaNatural
     *
     * @return FtRadicacionSalida
     */
    public function setPersonaNatural($personaNatural)
    {
        $this->personaNatural = $personaNatural;

        return $this;
    }

    /**
     * Get personaNatural
     *
     * @return string
     */
    public function getPersonaNatural()
    {
        return $this->personaNatural;
    }

    /**
     * Set descripcionSalida
     *
     * @param string $descripcionSalida
     *
     * @return FtRadicacionSalida
     */
    public function setDescripcionSalida($descripcionSalida)
    {
        $this->descripcionSalida = $descripcionSalida;

        return $this;
    }

    /**
     * Get descripcionSalida
     *
     * @return string
     */
    public function getDescripcionSalida()
    {
        return $this->descripcionSalida;
    }

    /**
     * Set descripcionAnexos
     *
     * @param string $descripcionAnexos
     *
     * @return FtRadicacionSalida
     */
    public function setDescripcionAnexos($descripcionAnexos)
    {
        $this->descripcionAnexos = $descripcionAnexos;

        return $this;
    }

    /**
     * Get descripcionAnexos
     *
     * @return string
     */
    public function getDescripcionAnexos()
    {
        return $this->descripcionAnexos;
    }

    /**
     * Set estadoRadicado
     *
     * @param string $estadoRadicado
     *
     * @return FtRadicacionSalida
     */
    public function setEstadoRadicado($estadoRadicado)
    {
        $this->estadoRadicado = $estadoRadicado;

        return $this;
    }

    /**
     * Get estadoRadicado
     *
     * @return string
     */
    public function getEstadoRadicado()
    {
        return $this->estadoRadicado;
    }

    /**
     * Set fechaRadicacionEntrada
     *
     * @param \DateTime $fechaRadicacionEntrada
     *
     * @return FtRadicacionSalida
     */
    public function setFechaRadicacionEntrada($fechaRadicacionEntrada)
    {
        $this->fechaRadicacionEntrada = $fechaRadicacionEntrada;

        return $this;
    }

    /**
     * Get fechaRadicacionEntrada
     *
     * @return \DateTime
     */
    public function getFechaRadicacionEntrada()
    {
        return $this->fechaRadicacionEntrada;
    }

    /**
     * Set numeroRadicado
     *
     * @param integer $numeroRadicado
     *
     * @return FtRadicacionSalida
     */
    public function setNumeroRadicado($numeroRadicado)
    {
        $this->numeroRadicado = $numeroRadicado;

        return $this;
    }

    /**
     * Get numeroRadicado
     *
     * @return integer
     */
    public function getNumeroRadicado()
    {
        return $this->numeroRadicado;
    }

    /**
     * Set areaResponsable
     *
     * @param string $areaResponsable
     *
     * @return FtRadicacionSalida
     */
    public function setAreaResponsable($areaResponsable)
    {
        $this->areaResponsable = $areaResponsable;

        return $this;
    }

    /**
     * Get areaResponsable
     *
     * @return string
     */
    public function getAreaResponsable()
    {
        return $this->areaResponsable;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtRadicacionSalida
     */
    public function setTipoMensajeria($tipoMensajeria)
    {
        $this->tipoMensajeria = $tipoMensajeria;

        return $this;
    }

    /**
     * Get tipoMensajeria
     *
     * @return integer
     */
    public function getTipoMensajeria()
    {
        return $this->tipoMensajeria;
    }

    /**
     * Set mensajeros
     *
     * @param integer $mensajeros
     *
     * @return FtRadicacionSalida
     */
    public function setMensajeros($mensajeros)
    {
        $this->mensajeros = $mensajeros;

        return $this;
    }

    /**
     * Get mensajeros
     *
     * @return integer
     */
    public function getMensajeros()
    {
        return $this->mensajeros;
    }

    /**
     * Set numFolios
     *
     * @param integer $numFolios
     *
     * @return FtRadicacionSalida
     */
    public function setNumFolios($numFolios)
    {
        $this->numFolios = $numFolios;

        return $this;
    }

    /**
     * Get numFolios
     *
     * @return integer
     */
    public function getNumFolios()
    {
        return $this->numFolios;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRadicacionSalida
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
