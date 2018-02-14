<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPasoAccion
 *
 * @ORM\Table(name="funciones_paso_accion")
 * @ORM\Entity
 */
class FuncionesPasoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_paso_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionesPasoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_idfunciones_paso", type="integer", nullable=false)
     */
    private $pasoIdfuncionesPaso;



    /**
     * Get idfuncionesPasoAccion
     *
     * @return integer
     */
    public function getIdfuncionesPasoAccion()
    {
        return $this->idfuncionesPasoAccion;
    }

    /**
     * Set accionIdaccion
     *
     * @param integer $accionIdaccion
     *
     * @return FuncionesPasoAccion
     */
    public function setAccionIdaccion($accionIdaccion)
    {
        $this->accionIdaccion = $accionIdaccion;

        return $this;
    }

    /**
     * Get accionIdaccion
     *
     * @return integer
     */
    public function getAccionIdaccion()
    {
        return $this->accionIdaccion;
    }

    /**
     * Set pasoIdfuncionesPaso
     *
     * @param integer $pasoIdfuncionesPaso
     *
     * @return FuncionesPasoAccion
     */
    public function setPasoIdfuncionesPaso($pasoIdfuncionesPaso)
    {
        $this->pasoIdfuncionesPaso = $pasoIdfuncionesPaso;

        return $this;
    }

    /**
     * Get pasoIdfuncionesPaso
     *
     * @return integer
     */
    public function getPasoIdfuncionesPaso()
    {
        return $this->pasoIdfuncionesPaso;
    }
}
