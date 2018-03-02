<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadPretexto
 *
 * @ORM\Table(name="entidad_pretexto")
 * @ORM\Entity
 */
class EntidadPretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_pretexto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identidadPretexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="pretexto_idpretexto", type="integer", nullable=false)
     */
    private $pretextoIdpretexto = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;



    /**
     * Get identidadPretexto
     *
     * @return integer
     */
    public function getIdentidadPretexto()
    {
        return $this->identidadPretexto;
    }

    /**
     * Set pretextoIdpretexto
     *
     * @param integer $pretextoIdpretexto
     *
     * @return EntidadPretexto
     */
    public function setPretextoIdpretexto($pretextoIdpretexto)
    {
        $this->pretextoIdpretexto = $pretextoIdpretexto;

        return $this;
    }

    /**
     * Get pretextoIdpretexto
     *
     * @return integer
     */
    public function getPretextoIdpretexto()
    {
        return $this->pretextoIdpretexto;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return EntidadPretexto
     */
    public function setEntidadIdentidad($entidadIdentidad)
    {
        $this->entidadIdentidad = $entidadIdentidad;

        return $this;
    }

    /**
     * Get entidadIdentidad
     *
     * @return integer
     */
    public function getEntidadIdentidad()
    {
        return $this->entidadIdentidad;
    }

    /**
     * Set llaveEntidad
     *
     * @param integer $llaveEntidad
     *
     * @return EntidadPretexto
     */
    public function setLlaveEntidad($llaveEntidad)
    {
        $this->llaveEntidad = $llaveEntidad;

        return $this;
    }

    /**
     * Get llaveEntidad
     *
     * @return integer
     */
    public function getLlaveEntidad()
    {
        return $this->llaveEntidad;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return EntidadPretexto
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EntidadPretexto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
