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
     * @ORM\Column(name="SOLICITUD_DOCUMENTO_IDDOCUMENT", type="integer", nullable=false)
     */
    private $solicitudDocumentoIddocument;

    /**
     * @var integer
     *
     * @ORM\Column(name="SOLICITUD_IDSOLICITUD", type="integer", nullable=false)
     */
    private $solicitudIdsolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="SOLICITUD_INVESTIGADOR_IDINVES", type="integer", nullable=false)
     */
    private $solicitudInvestigadorIdinves;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=true)
     */
    private $fechaFinal;


}

