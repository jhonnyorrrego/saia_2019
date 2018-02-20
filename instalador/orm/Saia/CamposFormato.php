<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CamposFormato
 *
 * @ORM\Table(name="campos_formato", uniqueConstraints={@ORM\UniqueConstraint(name="ix_campos_formato_formato", columns={"formato_idformato", "nombre"})}, indexes={@ORM\Index(name="i_campos_forma_formato_idfo", columns={"formato_idformato"})})
 * @ORM\Entity
 */
class CamposFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcamposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato = '0';

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
     * @ORM\Column(name="obligatoriedad", type="boolean", nullable=false)
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
     * @var integer
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
     * Get idcamposFormato
     *
     * @return integer
     */
    public function getIdcamposFormato()
    {
        return $this->idcamposFormato;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return CamposFormato
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @param integer $orden
     *
     * @return CamposFormato
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
     * @return CamposFormato
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
}
