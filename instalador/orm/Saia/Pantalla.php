<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pantalla
 *
 * @ORM\Table(name="pantalla")
 * @ORM\Entity
 */
class Pantalla
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantalla;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_pantalla", type="integer", nullable=false)
     */
    private $tipoPantalla = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="text", length=65535, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=255, nullable=true)
     */
    private $banderas;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_autoguardado", type="integer", nullable=false)
     */
    private $tiempoAutoguardado = '300000';

    /**
     * @var integer
     *
     * @ORM\Column(name="submit_formulario", type="integer", nullable=false)
     */
    private $submitFormulario = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="versionar", type="integer", nullable=true)
     */
    private $versionar;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_pantalla", type="string", length=255, nullable=true)
     */
    private $rutaPantalla = 'pantallas';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_almacenamiento", type="string", length=255, nullable=true)
     */
    private $rutaAlmacenamiento = '{*fecha_ano*}/{*fecha_mes*}/{*idpantalla*}';

    /**
     * @var string
     *
     * @ORM\Column(name="prefijo", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_edicion", type="integer", nullable=true)
     */
    private $tipoEdicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_pantalla", type="integer", nullable=true)
     */
    private $ordenPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="enter2tab", type="integer", nullable=true)
     */
    private $enter2tab;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idpantalla_categoria", type="string", length=255, nullable=true)
     */
    private $fkIdpantallaCategoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase", type="integer", nullable=true)
     */
    private $clase;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprobacion_automatica", type="integer", nullable=true)
     */
    private $aprobacionAutomatica = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="afecta_documento", type="integer", nullable=true)
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
