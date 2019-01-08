<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campos
 *
 * @ORM\Table(name="campos")
 * @ORM\Entity
 */
class Campos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcampos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     */
    private $alias = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255, nullable=false)
     */
    private $tabla = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo = 'TEXT';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=255, nullable=true)
     */
    private $ayuda;

    /**
     * @var integer
     *
     * @ORM\Column(name="visible", type="integer", nullable=false)
     */
    private $visible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="seleccionado", type="string", length=1, nullable=false)
     */
    private $seleccionado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=20, nullable=false)
     */
    private $tipoDato = 'varchar';



    /**
     * Get idcampos
     *
     * @return integer
     */
    public function getIdcampos()
    {
        return $this->idcampos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Campos
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Campos
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set tabla
     *
     * @param string $tabla
     *
     * @return Campos
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Campos
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
     * Set valor
     *
     * @param string $valor
     *
     * @return Campos
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
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return Campos
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
     * Set visible
     *
     * @param integer $visible
     *
     * @return Campos
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return integer
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set seleccionado
     *
     * @param string $seleccionado
     *
     * @return Campos
     */
    public function setSeleccionado($seleccionado)
    {
        $this->seleccionado = $seleccionado;

        return $this;
    }

    /**
     * Get seleccionado
     *
     * @return string
     */
    public function getSeleccionado()
    {
        return $this->seleccionado;
    }

    /**
     * Set tipoDato
     *
     * @param string $tipoDato
     *
     * @return Campos
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
}
