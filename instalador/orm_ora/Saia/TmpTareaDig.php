<?php

namespace Saia;

/**
 * TmpTareaDig
 */
class TmpTareaDig
{
    /**
     * @var integer
     */
    private $idtareaDig;

    /**
     * @var integer
     */
    private $idfuncionario;

    /**
     * @var integer
     */
    private $iddocumento;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get idtareaDig
     *
     * @return integer
     */
    public function getIdtareaDig()
    {
        return $this->idtareaDig;
    }

    /**
     * Set idfuncionario
     *
     * @param integer $idfuncionario
     *
     * @return TmpTareaDig
     */
    public function setIdfuncionario($idfuncionario)
    {
        $this->idfuncionario = $idfuncionario;

        return $this;
    }

    /**
     * Get idfuncionario
     *
     * @return integer
     */
    public function getIdfuncionario()
    {
        return $this->idfuncionario;
    }

    /**
     * Set iddocumento
     *
     * @param integer $iddocumento
     *
     * @return TmpTareaDig
     */
    public function setIddocumento($iddocumento)
    {
        $this->iddocumento = $iddocumento;

        return $this;
    }

    /**
     * Get iddocumento
     *
     * @return integer
     */
    public function getIddocumento()
    {
        return $this->iddocumento;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return TmpTareaDig
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
     * @return TmpTareaDig
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

