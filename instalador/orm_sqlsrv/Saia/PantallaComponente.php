<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaComponente
 *
 * @ORM\Table(name="pantalla_componente")
 * @ORM\Entity
 */
class PantallaComponente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_componente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="clase", type="string", length=255, nullable=false)
     */
    private $clase;

    /**
     * @var string
     *
     * @ORM\Column(name="componente", type="text", length=65535, nullable=false)
     */
    private $componente;

    /**
     * @var string
     *
     * @ORM\Column(name="opciones", type="text", length=65535, nullable=false)
     */
    private $opciones;

    /**
     * @var string
     *
     * @ORM\Column(name="procesar", type="string", length=255, nullable=true)
     */
    private $procesar;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=false)
     */
    private $categoria = 'I';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="string", length=3999, nullable=true)
     */
    private $librerias;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_componente", type="integer", nullable=false)
     */
    private $tipoComponente = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="eliminar", type="string", length=255, nullable=false)
     */
    private $eliminar;



    /**
     * Get idpantallaComponente
     *
     * @return integer
     */
    public function getIdpantallaComponente()
    {
        return $this->idpantallaComponente;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaComponente
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
     * @return PantallaComponente
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
     * Set clase
     *
     * @param string $clase
     *
     * @return PantallaComponente
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return string
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set componente
     *
     * @param string $componente
     *
     * @return PantallaComponente
     */
    public function setComponente($componente)
    {
        $this->componente = $componente;

        return $this;
    }

    /**
     * Get componente
     *
     * @return string
     */
    public function getComponente()
    {
        return $this->componente;
    }

    /**
     * Set opciones
     *
     * @param string $opciones
     *
     * @return PantallaComponente
     */
    public function setOpciones($opciones)
    {
        $this->opciones = $opciones;

        return $this;
    }

    /**
     * Get opciones
     *
     * @return string
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set procesar
     *
     * @param string $procesar
     *
     * @return PantallaComponente
     */
    public function setProcesar($procesar)
    {
        $this->procesar = $procesar;

        return $this;
    }

    /**
     * Get procesar
     *
     * @return string
     */
    public function getProcesar()
    {
        return $this->procesar;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return PantallaComponente
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return PantallaComponente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set librerias
     *
     * @param string $librerias
     *
     * @return PantallaComponente
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
     * Set tipoComponente
     *
     * @param integer $tipoComponente
     *
     * @return PantallaComponente
     */
    public function setTipoComponente($tipoComponente)
    {
        $this->tipoComponente = $tipoComponente;

        return $this;
    }

    /**
     * Get tipoComponente
     *
     * @return integer
     */
    public function getTipoComponente()
    {
        return $this->tipoComponente;
    }

    /**
     * Set eliminar
     *
     * @param string $eliminar
     *
     * @return PantallaComponente
     */
    public function setEliminar($eliminar)
    {
        $this->eliminar = $eliminar;

        return $this;
    }

    /**
     * Get eliminar
     *
     * @return string
     */
    public function getEliminar()
    {
        return $this->eliminar;
    }
}
