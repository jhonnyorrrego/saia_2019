<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoEquivalencia
 *
 * @ORM\Table(name="reemplazo_equivalencia")
 * @ORM\Entity
 */
class ReemplazoEquivalencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_equivalencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreemplazoEquivalencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad_origen", type="integer", nullable=false)
     */
    private $llaveEntidadOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad_destino", type="integer", nullable=false)
     */
    private $llaveEntidadDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idreemplazo_saia", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;



    /**
     * Get idreemplazoEquivalencia
     *
     * @return integer
     */
    public function getIdreemplazoEquivalencia()
    {
        return $this->idreemplazoEquivalencia;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return ReemplazoEquivalencia
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
     * Set llaveEntidadOrigen
     *
     * @param integer $llaveEntidadOrigen
     *
     * @return ReemplazoEquivalencia
     */
    public function setLlaveEntidadOrigen($llaveEntidadOrigen)
    {
        $this->llaveEntidadOrigen = $llaveEntidadOrigen;

        return $this;
    }

    /**
     * Get llaveEntidadOrigen
     *
     * @return integer
     */
    public function getLlaveEntidadOrigen()
    {
        return $this->llaveEntidadOrigen;
    }

    /**
     * Set llaveEntidadDestino
     *
     * @param integer $llaveEntidadDestino
     *
     * @return ReemplazoEquivalencia
     */
    public function setLlaveEntidadDestino($llaveEntidadDestino)
    {
        $this->llaveEntidadDestino = $llaveEntidadDestino;

        return $this;
    }

    /**
     * Get llaveEntidadDestino
     *
     * @return integer
     */
    public function getLlaveEntidadDestino()
    {
        return $this->llaveEntidadDestino;
    }

    /**
     * Set fkIdreemplazoSaia
     *
     * @param integer $fkIdreemplazoSaia
     *
     * @return ReemplazoEquivalencia
     */
    public function setFkIdreemplazoSaia($fkIdreemplazoSaia)
    {
        $this->fkIdreemplazoSaia = $fkIdreemplazoSaia;

        return $this;
    }

    /**
     * Get fkIdreemplazoSaia
     *
     * @return integer
     */
    public function getFkIdreemplazoSaia()
    {
        return $this->fkIdreemplazoSaia;
    }
}
