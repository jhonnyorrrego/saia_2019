<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareaDig
 *
 * @ORM\Table(name="tarea_dig")
 * @ORM\Entity
 */
class TareaDig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtarea_dig", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareaDig;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario", type="integer", nullable=false)
     */
    private $idfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento", type="integer", nullable=false)
     */
    private $iddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_ip", type="string", length=20, nullable=true)
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
