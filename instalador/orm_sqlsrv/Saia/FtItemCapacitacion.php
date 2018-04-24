<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemCapacitacion
 *
 * @ORM\Table(name="ft_item_capacitacion")
 * @ORM\Entity
 */
class FtItemCapacitacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_capacitacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemCapacitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="conocimiento_personal", type="string", length=255, nullable=false)
     */
    private $conocimientoPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="conocimiento_tecnico", type="string", length=255, nullable=false)
     */
    private $conocimientoTecnico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_encuesta_ingreso", type="integer", nullable=false)
     */
    private $ftEncuestaIngreso;


}

