<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaCampos
 *
 * @ORM\Table(name="pantalla_campos", indexes={@ORM\Index(name="fk_pantalla_campos_pantalla1_idx", columns={"pantalla_idpantalla"})})
 * @ORM\Entity
 */
class PantallaCampos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_campos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaCampos;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255, nullable=false)
     */
    private $tabla;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=false)
     */
    private $tipoDato = '';

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obligatoriedad", type="integer", nullable=false)
     */
    private $obligatoriedad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="text", length=65535, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones", type="string", length=10, nullable=true)
     */
    private $acciones = 'a,e,b';

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="predeterminado", type="string", length=255, nullable=true)
     */
    private $predeterminado;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=50, nullable=true)
     */
    private $banderas;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_html", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml = 'text';

    /**
     * @var boolean
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="mascara", type="string", length=255, nullable=true)
     */
    private $mascara;

    /**
     * @var string
     *
     * @ORM\Column(name="adicionales", type="string", length=255, nullable=true)
     */
    private $adicionales;

    /**
     * @var integer
     *
     * @ORM\Column(name="autoguardado", type="integer", nullable=false)
     */
    private $autoguardado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fila_visible", type="integer", nullable=true)
     */
    private $filaVisible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="placeholder", type="string", length=255, nullable=true)
     */
    private $placeholder;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
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
