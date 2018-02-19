<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="RESERVA")
 * @ORM\Entity
 */
class Reserva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDRESERVA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="RESERVA_IDRESERVA_seq", allocationSize=1, initialValue=1)
     */
    private $idreserva;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="SOLICITUD_IDSOLICITUD", type="integer", nullable=true)
     */
    private $solicitudIdsolicitud = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="INVESTIGADOR_IDINVESTIGADOR", type="integer", nullable=true)
     */
    private $investigadorIdinvestigador = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=true)
     */
    private $fechaInicial = 'TO_DATE(\'01-01-70 00:00:00\', \'dd-mm-yy hh24:mi:ss\')';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=true)
     */
    private $fechaFinal;


}

