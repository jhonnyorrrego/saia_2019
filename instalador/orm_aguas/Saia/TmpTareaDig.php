<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TmpTareaDig
 *
 * @ORM\Table(name="tmp_tarea_dig")
 * @ORM\Entity
 */
class TmpTareaDig
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
