<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="RESPUESTA")
 * @ORM\Entity
 */
class Respuesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDRESPUESTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="RESPUESTA_IDRESPUESTA_seq", allocationSize=1, initialValue=1)
     */
    private $idrespuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'TO_DATE(\'01-01-70 00:00:00\', \'dd-mm-yy hh24:mi:ss\')';

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=true)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=true)
     */
    private $origen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUZON", type="integer", nullable=true)
     */
    private $idbuzon = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PLANTILLA", type="string", length=30, nullable=true)
     */
    private $plantilla = 'CARTA';


}
