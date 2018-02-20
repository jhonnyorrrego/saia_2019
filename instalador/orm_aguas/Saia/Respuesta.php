<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="RESPUESTA", indexes={@ORM\Index(name="i_respuesta_destino", columns={"DESTINO"}), @ORM\Index(name="i_respuesta_origen", columns={"ORIGEN"})})
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
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=false)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=false)
     */
    private $origen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUZON", type="integer", nullable=false)
     */
    private $idbuzon = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PLANTILLA", type="string", length=30, nullable=false)
     */
    private $plantilla = 'CARTA';


}
