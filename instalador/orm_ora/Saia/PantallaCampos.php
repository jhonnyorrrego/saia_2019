<?php

namespace Saia;

/**
 * PantallaCampos
 */
class PantallaCampos
{
    /**
     * @var integer
     */
    private $idpantallaCampos;

    /**
     * @var string
     */
    private $tabla;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $tipoDato;

    /**
     * @var string
     */
    private $longitud;

    /**
     * @var boolean
     */
    private $obligatoriedad;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $acciones;

    /**
     * @var string
     */
    private $ayuda;

    /**
     * @var string
     */
    private $predeterminado;

    /**
     * @var string
     */
    private $banderas;

    /**
     * @var string
     */
    private $etiquetaHtml;

    /**
     * @var boolean
     */
    private $orden;

    /**
     * @var string
     */
    private $mascara;

    /**
     * @var string
     */
    private $adicionales;

    /**
     * @var integer
     */
    private $autoguardado;

    /**
     * @var integer
     */
    private $filaVisible;

    /**
     * @var string
     */
    private $placeholder;

    /**
     * @var integer
     */
    private $pantallaIdpantalla;


    /**
     * Get idpantallaCampos
     *
     * @return integer
     */
    public function getIdpantallaCampos()
    {
        return $this->idpantallaCampos;
    }

    /**
     * Set tabla
     *
     * @param string $tabla
     *
     * @return PantallaCampos
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;

        return $this;
    }

    /**
     * Get tabla
     *
     * @return string
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaCampos
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PantallaCampos
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
     * Set tipoDato
     *
     * @param string $tipoDato
     *
     * @return PantallaCampos
     */
    public function setTipoDato($tipoDato)
    {
        $this->tipoDato = $tipoDato;

        return $this;
    }

    /**
     * Get tipoDato
     *
     * @return string
     */
    public function getTipoDato()
    {
        return $this->tipoDato;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     *
     * @return PantallaCampos
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return string
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set obligatoriedad
     *
     * @param boolean $obligatoriedad
     *
     * @return PantallaCampos
     */
    public function setObligatoriedad($obligatoriedad)
    {
        $this->obligatoriedad = $obligatoriedad;

        return $this;
    }

    /**
     * Get obligatoriedad
     *
     * @return boolean
     */
    public function getObligatoriedad()
    {
        return $this->obligatoriedad;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return PantallaCampos
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set acciones
     *
     * @param string $acciones
     *
     * @return PantallaCampos
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;

        return $this;
    }

    /**
     * Get acciones
     *
     * @return string
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return PantallaCampos
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
     * Set predeterminado
     *
     * @param string $predeterminado
     *
     * @return PantallaCampos
     */
    public function setPredeterminado($predeterminado)
    {
        $this->predeterminado = $predeterminado;

        return $this;
    }

    /**
     * Get predeterminado
     *
     * @return string
     */
    public function getPredeterminado()
    {
        return $this->predeterminado;
    }

    /**
     * Set banderas
     *
     * @param string $banderas
     *
     * @return PantallaCampos
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
     * Set etiquetaHtml
     *
     * @param string $etiquetaHtml
     *
     * @return PantallaCampos
     */
    public function setEtiquetaHtml($etiquetaHtml)
    {
        $this->etiquetaHtml = $etiquetaHtml;

        return $this;
    }

    /**
     * Get etiquetaHtml
     *
     * @return string
     */
    public function getEtiquetaHtml()
    {
        return $this->etiquetaHtml;
    }

    /**
     * Set orden
     *
     * @param boolean $orden
     *
     * @return PantallaCampos
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return boolean
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set mascara
     *
     * @param string $mascara
     *
     * @return PantallaCampos
     */
    public function setMascara($mascara)
    {
        $this->mascara = $mascara;

        return $this;
    }

    /**
     * Get mascara
     *
     * @return string
     */
    public function getMascara()
    {
        return $this->mascara;
    }

    /**
     * Set adicionales
     *
     * @param string $adicionales
     *
     * @return PantallaCampos
     */
    public function setAdicionales($adicionales)
    {
        $this->adicionales = $adicionales;

        return $this;
    }

    /**
     * Get adicionales
     *
     * @return string
     */
    public function getAdicionales()
    {
        return $this->adicionales;
    }

    /**
     * Set autoguardado
     *
     * @param integer $autoguardado
     *
     * @return PantallaCampos
     */
    public function setAutoguardado($autoguardado)
    {
        $this->autoguardado = $autoguardado;

        return $this;
    }

    /**
     * Get autoguardado
     *
     * @return integer
     */
    public function getAutoguardado()
    {
        return $this->autoguardado;
    }

    /**
     * Set filaVisible
     *
     * @param integer $filaVisible
     *
     * @return PantallaCampos
     */
    public function setFilaVisible($filaVisible)
    {
        $this->filaVisible = $filaVisible;

        return $this;
    }

    /**
     * Get filaVisible
     *
     * @return integer
     */
    public function getFilaVisible()
    {
        return $this->filaVisible;
    }

    /**
     * Set placeholder
     *
     * @param string $placeholder
     *
     * @return PantallaCampos
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder
     *
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaCampos
     */
    public function setPantallaIdpantalla($pantallaIdpantalla)
    {
        $this->pantallaIdpantalla = $pantallaIdpantalla;

        return $this;
    }

    /**
     * Get pantallaIdpantalla
     *
     * @return integer
     */
    public function getPantallaIdpantalla()
    {
        return $this->pantallaIdpantalla;
    }
}

