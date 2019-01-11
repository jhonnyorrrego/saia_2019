<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity
 */
class Respuesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrespuesta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrespuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=false)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idbuzon", type="integer", nullable=false)
     */
    private $idbuzon = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="plantilla", type="string", length=30, nullable=false)
     */
    private $plantilla = 'CARTA';


}

