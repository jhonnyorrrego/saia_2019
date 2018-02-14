<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table(name="cargo")
 * @ORM\Entity
 */
class Cargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcargo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_cargo", type="integer", nullable=true)
     */
    private $codigoCargo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_cargo", type="integer", nullable=false)
     */
    private $tipoCargo = '1';



    /**
     * Get idcargo
     *
     * @return integer
     */
    public function getIdcargo()
    {
        return $this->idcargo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cargo
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
     * @return Cargo
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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Cargo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set codigoCargo
     *
     * @param integer $codigoCargo
     *
     * @return Cargo
     */
    public function setCodigoCargo($codigoCargo)
    {
        $this->codigoCargo = $codigoCargo;

        return $this;
    }

    /**
     * Get codigoCargo
     *
     * @return integer
     */
    public function getCodigoCargo()
    {
        return $this->codigoCargo;
    }

    /**
     * Set tipo
     *
     * @param boolean $tipo
     *
     * @return Cargo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return boolean
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tipoCargo
     *
     * @param integer $tipoCargo
     *
     * @return Cargo
     */
    public function setTipoCargo($tipoCargo)
    {
        $this->tipoCargo = $tipoCargo;

        return $this;
    }

    /**
     * Get tipoCargo
     *
     * @return integer
     */
    public function getTipoCargo()
    {
        return $this->tipoCargo;
    }
}
