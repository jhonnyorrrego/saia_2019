<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="modulo", uniqueConstraints={@ORM\UniqueConstraint(name="nombre", columns={"nombre"}), @ORM\UniqueConstraint(name="nombre_2", columns={"nombre"})})
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmodulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idmodulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=false)
     */
    private $perteneceNucleo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo = 'secundario';

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen = 'botones/configuracion/default.gif';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta = '';

    /**
     * @var string
     *
     * @ORM\Column(name="enlace", type="string", length=255, nullable=false)
     */
    private $enlace = '';

    /**
     * @var string
     *
     * @ORM\Column(name="enlace_mobil", type="string", length=255, nullable=true)
     */
    private $enlaceMobil;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino = 'centro';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="orden", type="boolean", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=false)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permiso_admin", type="boolean", nullable=false)
     */
    private $permisoAdmin = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="busqueda", type="string", length=5, nullable=true)
     */
    private $busqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="enlace_pantalla", type="integer", nullable=true)
     */
    private $enlacePantalla = '0';



    /**
     * Get idmodulo
     *
     * @return integer
     */
    public function getIdmodulo()
    {
        return $this->idmodulo;
    }

    /**
     * Set perteneceNucleo
     *
     * @param integer $perteneceNucleo
     *
     * @return Modulo
     */
    public function setPerteneceNucleo($perteneceNucleo)
    {
        $this->perteneceNucleo = $perteneceNucleo;

        return $this;
    }

    /**
     * Get perteneceNucleo
     *
     * @return integer
     */
    public function getPerteneceNucleo()
    {
        return $this->perteneceNucleo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Modulo
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Modulo
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Modulo
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Modulo
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
     * Set enlace
     *
     * @param string $enlace
     *
     * @return Modulo
     */
    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;

        return $this;
    }

    /**
     * Get enlace
     *
     * @return string
     */
    public function getEnlace()
    {
        return $this->enlace;
    }

    /**
     * Set enlaceMobil
     *
     * @param string $enlaceMobil
     *
     * @return Modulo
     */
    public function setEnlaceMobil($enlaceMobil)
    {
        $this->enlaceMobil = $enlaceMobil;

        return $this;
    }

    /**
     * Get enlaceMobil
     *
     * @return string
     */
    public function getEnlaceMobil()
    {
        return $this->enlaceMobil;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return Modulo
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Modulo
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
     * Set orden
     *
     * @param boolean $orden
     *
     * @return Modulo
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
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return Modulo
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
     * Set parametros
     *
     * @param string $parametros
     *
     * @return Modulo
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;

        return $this;
    }

    /**
     * Get parametros
     *
     * @return string
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Set busquedaIdbusqueda
     *
     * @param integer $busquedaIdbusqueda
     *
     * @return Modulo
     */
    public function setBusquedaIdbusqueda($busquedaIdbusqueda)
    {
        $this->busquedaIdbusqueda = $busquedaIdbusqueda;

        return $this;
    }

    /**
     * Get busquedaIdbusqueda
     *
     * @return integer
     */
    public function getBusquedaIdbusqueda()
    {
        return $this->busquedaIdbusqueda;
    }

    /**
     * Set permisoAdmin
     *
     * @param boolean $permisoAdmin
     *
     * @return Modulo
     */
    public function setPermisoAdmin($permisoAdmin)
    {
        $this->permisoAdmin = $permisoAdmin;

        return $this;
    }

    /**
     * Get permisoAdmin
     *
     * @return boolean
     */
    public function getPermisoAdmin()
    {
        return $this->permisoAdmin;
    }

    /**
     * Set busqueda
     *
     * @param string $busqueda
     *
     * @return Modulo
     */
    public function setBusqueda($busqueda)
    {
        $this->busqueda = $busqueda;

        return $this;
    }

    /**
     * Get busqueda
     *
     * @return string
     */
    public function getBusqueda()
    {
        return $this->busqueda;
    }

    /**
     * Set enlacePantalla
     *
     * @param integer $enlacePantalla
     *
     * @return Modulo
     */
    public function setEnlacePantalla($enlacePantalla)
    {
        $this->enlacePantalla = $enlacePantalla;

        return $this;
    }

    /**
     * Get enlacePantalla
     *
     * @return integer
     */
    public function getEnlacePantalla()
    {
        return $this->enlacePantalla;
    }
}
