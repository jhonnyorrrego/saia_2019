<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSoporteDocumental
 *
 * @ORM\Table(name="ft_soporte_documental")
 * @ORM\Entity
 */
class FtSoporteDocumental
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_soporte_documental", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSoporteDocumental;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acopio", type="integer", nullable=false)
     */
    private $ftAcopio;

    /**
     * @var string
     *
     * @ORM\Column(name="soportes_documental", type="string", length=255, nullable=false)
     */
    private $soportesDocumental;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_soporte", type="integer", nullable=false)
     */
    private $tipoSoporte;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;



    /**
     * Get idftSoporteDocumental
     *
     * @return integer
     */
    public function getIdftSoporteDocumental()
    {
        return $this->idftSoporteDocumental;
    }

    /**
     * Set ftAcopio
     *
     * @param integer $ftAcopio
     *
     * @return FtSoporteDocumental
     */
    public function setFtAcopio($ftAcopio)
    {
        $this->ftAcopio = $ftAcopio;

        return $this;
    }

    /**
     * Get ftAcopio
     *
     * @return integer
     */
    public function getFtAcopio()
    {
        return $this->ftAcopio;
    }

    /**
     * Set soportesDocumental
     *
     * @param string $soportesDocumental
     *
     * @return FtSoporteDocumental
     */
    public function setSoportesDocumental($soportesDocumental)
    {
        $this->soportesDocumental = $soportesDocumental;

        return $this;
    }

    /**
     * Get soportesDocumental
     *
     * @return string
     */
    public function getSoportesDocumental()
    {
        return $this->soportesDocumental;
    }

    /**
     * Set tipoSoporte
     *
     * @param integer $tipoSoporte
     *
     * @return FtSoporteDocumental
     */
    public function setTipoSoporte($tipoSoporte)
    {
        $this->tipoSoporte = $tipoSoporte;

        return $this;
    }

    /**
     * Get tipoSoporte
     *
     * @return integer
     */
    public function getTipoSoporte()
    {
        return $this->tipoSoporte;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSoporteDocumental
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
