<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReadh
 *
 * @ORM\Table(name="ft_readh")
 * @ORM\Entity
 */
class FtReadh
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_readh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftReadh;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1052';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_entidad", type="integer", nullable=true)
     */
    private $tipoEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="enfoque_diferencial", type="integer", nullable=false)
     */
    private $enfoqueDiferencial;

    /**
     * @var integer
     *
     * @ORM\Column(name="ubicacion_geografica", type="integer", nullable=true)
     */
    private $ubicacionGeografica;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_entidad", type="integer", nullable=false)
     */
    private $nombreEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paralelo", type="string", length=255, nullable=true)
     */
    private $nombreParalelo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_readh", type="text", length=65535, nullable=true)
     */
    private $descripcionReadh;

    /**
     * @var string
     *
     * @ORM\Column(name="contexto_geografico", type="text", length=65535, nullable=true)
     */
    private $contextoGeografico;

    /**
     * @var integer
     *
     * @ORM\Column(name="registro_funciones", type="integer", nullable=true)
     */
    private $registroFunciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_registro", type="integer", nullable=false)
     */
    private $estadoRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="palabras_clave", type="integer", nullable=true)
     */
    private $palabrasClave;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

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
     * Get idftReadh
     *
     * @return integer
     */
    public function getIdftReadh()
    {
        return $this->idftReadh;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReadh
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
     * Set tipoEntidad
     *
     * @param integer $tipoEntidad
     *
     * @return FtReadh
     */
    public function setTipoEntidad($tipoEntidad)
    {
        $this->tipoEntidad = $tipoEntidad;

        return $this;
    }

    /**
     * Get tipoEntidad
     *
     * @return integer
     */
    public function getTipoEntidad()
    {
        return $this->tipoEntidad;
    }

    /**
     * Set enfoqueDiferencial
     *
     * @param integer $enfoqueDiferencial
     *
     * @return FtReadh
     */
    public function setEnfoqueDiferencial($enfoqueDiferencial)
    {
        $this->enfoqueDiferencial = $enfoqueDiferencial;

        return $this;
    }

    /**
     * Get enfoqueDiferencial
     *
     * @return integer
     */
    public function getEnfoqueDiferencial()
    {
        return $this->enfoqueDiferencial;
    }

    /**
     * Set ubicacionGeografica
     *
     * @param integer $ubicacionGeografica
     *
     * @return FtReadh
     */
    public function setUbicacionGeografica($ubicacionGeografica)
    {
        $this->ubicacionGeografica = $ubicacionGeografica;

        return $this;
    }

    /**
     * Get ubicacionGeografica
     *
     * @return integer
     */
    public function getUbicacionGeografica()
    {
        return $this->ubicacionGeografica;
    }

    /**
     * Set nombreEntidad
     *
     * @param integer $nombreEntidad
     *
     * @return FtReadh
     */
    public function setNombreEntidad($nombreEntidad)
    {
        $this->nombreEntidad = $nombreEntidad;

        return $this;
    }

    /**
     * Get nombreEntidad
     *
     * @return integer
     */
    public function getNombreEntidad()
    {
        return $this->nombreEntidad;
    }

    /**
     * Set nombreParalelo
     *
     * @param string $nombreParalelo
     *
     * @return FtReadh
     */
    public function setNombreParalelo($nombreParalelo)
    {
        $this->nombreParalelo = $nombreParalelo;

        return $this;
    }

    /**
     * Get nombreParalelo
     *
     * @return string
     */
    public function getNombreParalelo()
    {
        return $this->nombreParalelo;
    }

    /**
     * Set descripcionReadh
     *
     * @param string $descripcionReadh
     *
     * @return FtReadh
     */
    public function setDescripcionReadh($descripcionReadh)
    {
        $this->descripcionReadh = $descripcionReadh;

        return $this;
    }

    /**
     * Get descripcionReadh
     *
     * @return string
     */
    public function getDescripcionReadh()
    {
        return $this->descripcionReadh;
    }

    /**
     * Set contextoGeografico
     *
     * @param string $contextoGeografico
     *
     * @return FtReadh
     */
    public function setContextoGeografico($contextoGeografico)
    {
        $this->contextoGeografico = $contextoGeografico;

        return $this;
    }

    /**
     * Get contextoGeografico
     *
     * @return string
     */
    public function getContextoGeografico()
    {
        return $this->contextoGeografico;
    }

    /**
     * Set registroFunciones
     *
     * @param integer $registroFunciones
     *
     * @return FtReadh
     */
    public function setRegistroFunciones($registroFunciones)
    {
        $this->registroFunciones = $registroFunciones;

        return $this;
    }

    /**
     * Get registroFunciones
     *
     * @return integer
     */
    public function getRegistroFunciones()
    {
        return $this->registroFunciones;
    }

    /**
     * Set estadoRegistro
     *
     * @param integer $estadoRegistro
     *
     * @return FtReadh
     */
    public function setEstadoRegistro($estadoRegistro)
    {
        $this->estadoRegistro = $estadoRegistro;

        return $this;
    }

    /**
     * Get estadoRegistro
     *
     * @return integer
     */
    public function getEstadoRegistro()
    {
        return $this->estadoRegistro;
    }

    /**
     * Set palabrasClave
     *
     * @param integer $palabrasClave
     *
     * @return FtReadh
     */
    public function setPalabrasClave($palabrasClave)
    {
        $this->palabrasClave = $palabrasClave;

        return $this;
    }

    /**
     * Get palabrasClave
     *
     * @return integer
     */
    public function getPalabrasClave()
    {
        return $this->palabrasClave;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtReadh
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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
