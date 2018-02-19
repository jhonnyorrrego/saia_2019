<?php

namespace Saia;

/**
 * TareaDig
 */
class TareaDig
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
     * @var string
     */
    private $direccionIp;


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
     * @return TareaDig
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
     * @return TareaDig
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
     * @return TareaDig
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
     * @return TareaDig
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

    /**
     * Set direccionIp
     *
     * @param string $direccionIp
     *
     * @return TareaDig
     */
    public function setDireccionIp($direccionIp)
    {
        $this->direccionIp = $direccionIp;

        return $this;
    }

    /**
     * Get direccionIp
     *
     * @return string
     */
    public function getDireccionIp()
    {
        return $this->direccionIp;
    }
}

