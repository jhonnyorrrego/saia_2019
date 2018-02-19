<?php

namespace Saia;

/**
 * ReemplazoEquivalencia
 */
class ReemplazoEquivalencia
{
    /**
     * @var integer
     */
    private $idreemplazoEquivalencia;

    /**
     * @var integer
     */
    private $entidadIdentidad;

    /**
     * @var integer
     */
    private $llaveEntidadOrigen;

    /**
     * @var integer
     */
    private $llaveEntidadDestino;

    /**
     * @var integer
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

