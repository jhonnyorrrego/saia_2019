<?php

namespace Saia;

/**
 * Pantalla
 */
class Pantalla
{
    /**
     * @var integer
     */
    private $idpantalla;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $codPadre;

    /**
     * @var integer
     */
    private $tipoPantalla;

    /**
     * @var string
     */
    private $librerias;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $ayuda;

    /**
     * @var string
     */
    private $banderas;

    /**
     * @var integer
     */
    private $tiempoAutoguardado;

    /**
     * @var integer
     */
    private $submitFormulario;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $versionar;

    /**
     * @var string
     */
    private $rutaPantalla;

    /**
     * @var string
     */
    private $rutaAlmacenamiento;

    /**
     * @var string
     */
    private $prefijo;

    /**
     * @var integer
     */
    private $tipoEdicion;

    /**
     * @var integer
     */
    private $ordenPantalla;

    /**
     * @var integer
     */
    private $enter2tab;

    /**
     * @var string
     */
    private $fkIdpantallaCategoria;

    /**
     * @var integer
     */
    private $clase;

    /**
     * @var integer
     */
    private $aprobacionAutomatica;

    /**
     * @var integer
     */
    private $afectaDocumento;


    /**
     * Get idpantalla
     *
     * @return integer
     */
    public function getIdpantalla()
    {
        return $this->idpantalla;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Pantalla
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
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Pantalla
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set tipoPantalla
     *
     * @param integer $tipoPantalla
     *
     * @return Pantalla
     */
    public function setTipoPantalla($tipoPantalla)
    {
        $this->tipoPantalla = $tipoPantalla;

        return $this;
    }

    /**
     * Get tipoPantalla
     *
     * @return integer
     */
    public function getTipoPantalla()
    {
        return $this->tipoPantalla;
    }

    /**
     * Set librerias
     *
     * @param string $librerias
     *
     * @return Pantalla
     */
    public function setLibrerias($librerias)
    {
        $this->librerias = $librerias;

        return $this;
    }

    /**
     * Get librerias
     *
     * @return string
     */
    public function getLibrerias()
    {
        return $this->librerias;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Pantalla
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Pantalla
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return Pantalla
     */
    public function setAyuda($ayuda)
    {
        $this->ayuda = $ayuda;

        return $this;
    }

    /**
     * Get ayuda
     *
     * @return string
     */
    public function getAyuda()
    {
        return $this->ayuda;
    }

    /**
     * Set banderas
     *
     * @param string $banderas
     *
     * @return Pantalla
     */
    public function setBanderas($banderas)
    {
        $this->banderas = $banderas;

        return $this;
    }

    /**
     * Get banderas
     *
     * @return string
     */
    public function getBanderas()
    {
        return $this->banderas;
    }

    /**
     * Set tiempoAutoguardado
     *
     * @param integer $tiempoAutoguardado
     *
     * @return Pantalla
     */
    public function setTiempoAutoguardado($tiempoAutoguardado)
    {
        $this->tiempoAutoguardado = $tiempoAutoguardado;

        return $this;
    }

    /**
     * Get tiempoAutoguardado
     *
     * @return integer
     */
    public function getTiempoAutoguardado()
    {
        return $this->tiempoAutoguardado;
    }

    /**
     * Set submitFormulario
     *
     * @param integer $submitFormulario
     *
     * @return Pantalla
     */
    public function setSubmitFormulario($submitFormulario)
    {
        $this->submitFormulario = $submitFormulario;

        return $this;
    }

    /**
     * Get submitFormulario
     *
     * @return integer
     */
    public function getSubmitFormulario()
    {
        return $this->submitFormulario;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Pantalla
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set versionar
     *
     * @param integer $versionar
     *
     * @return Pantalla
     */
    public function setVersionar($versionar)
    {
        $this->versionar = $versionar;

        return $this;
    }

    /**
     * Get versionar
     *
     * @return integer
     */
    public function getVersionar()
    {
        return $this->versionar;
    }

    /**
     * Set rutaPantalla
     *
     * @param string $rutaPantalla
     *
     * @return Pantalla
     */
    public function setRutaPantalla($rutaPantalla)
    {
        $this->rutaPantalla = $rutaPantalla;

        return $this;
    }

    /**
     * Get rutaPantalla
     *
     * @return string
     */
    public function getRutaPantalla()
    {
        return $this->rutaPantalla;
    }

    /**
     * Set rutaAlmacenamiento
     *
     * @param string $rutaAlmacenamiento
     *
     * @return Pantalla
     */
    public function setRutaAlmacenamiento($rutaAlmacenamiento)
    {
        $this->rutaAlmacenamiento = $rutaAlmacenamiento;

        return $this;
    }

    /**
     * Get rutaAlmacenamiento
     *
     * @return string
     */
    public function getRutaAlmacenamiento()
    {
        return $this->rutaAlmacenamiento;
    }

    /**
     * Set prefijo
     *
     * @param string $prefijo
     *
     * @return Pantalla
     */
    public function setPrefijo($prefijo)
    {
        $this->prefijo = $prefijo;

        return $this;
    }

    /**
     * Get prefijo
     *
     * @return string
     */
    public function getPrefijo()
    {
        return $this->prefijo;
    }

    /**
     * Set tipoEdicion
     *
     * @param integer $tipoEdicion
     *
     * @return Pantalla
     */
    public function setTipoEdicion($tipoEdicion)
    {
        $this->tipoEdicion = $tipoEdicion;

        return $this;
    }

    /**
     * Get tipoEdicion
     *
     * @return integer
     */
    public function getTipoEdicion()
    {
        return $this->tipoEdicion;
    }

    /**
     * Set ordenPantalla
     *
     * @param integer $ordenPantalla
     *
     * @return Pantalla
     */
    public function setOrdenPantalla($ordenPantalla)
    {
        $this->ordenPantalla = $ordenPantalla;

        return $this;
    }

    /**
     * Get ordenPantalla
     *
     * @return integer
     */
    public function getOrdenPantalla()
    {
        return $this->ordenPantalla;
    }

    /**
     * Set enter2tab
     *
     * @param integer $enter2tab
     *
     * @return Pantalla
     */
    public function setEnter2tab($enter2tab)
    {
        $this->enter2tab = $enter2tab;

        return $this;
    }

    /**
     * Get enter2tab
     *
     * @return integer
     */
    public function getEnter2tab()
    {
        return $this->enter2tab;
    }

    /**
     * Set fkIdpantallaCategoria
     *
     * @param string $fkIdpantallaCategoria
     *
     * @return Pantalla
     */
    public function setFkIdpantallaCategoria($fkIdpantallaCategoria)
    {
        $this->fkIdpantallaCategoria = $fkIdpantallaCategoria;

        return $this;
    }

    /**
     * Get fkIdpantallaCategoria
     *
     * @return string
     */
    public function getFkIdpantallaCategoria()
    {
        return $this->fkIdpantallaCategoria;
    }

    /**
     * Set clase
     *
     * @param integer $clase
     *
     * @return Pantalla
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return integer
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set aprobacionAutomatica
     *
     * @param integer $aprobacionAutomatica
     *
     * @return Pantalla
     */
    public function setAprobacionAutomatica($aprobacionAutomatica)
    {
        $this->aprobacionAutomatica = $aprobacionAutomatica;

        return $this;
    }

    /**
     * Get aprobacionAutomatica
     *
     * @return integer
     */
    public function getAprobacionAutomatica()
    {
        return $this->aprobacionAutomatica;
    }

    /**
     * Set afectaDocumento
     *
     * @param integer $afectaDocumento
     *
     * @return Pantalla
     */
    public function setAfectaDocumento($afectaDocumento)
    {
        $this->afectaDocumento = $afectaDocumento;

        return $this;
    }

    /**
     * Get afectaDocumento
     *
     * @return integer
     */
    public function getAfectaDocumento()
    {
        return $this->afectaDocumento;
    }
}

