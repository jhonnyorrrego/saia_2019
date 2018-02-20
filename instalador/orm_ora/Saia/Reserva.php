<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity
 */
class Reserva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="RESERVA_IDRESERVA_seq", allocationSize=1, initialValue=1)
     */
    private $idreserva;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitud_documento_iddocument", type="integer", nullable=false)
     */
    private $solicitudDocumentoIddocument;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitud_idsolicitud", type="integer", nullable=false)
     */
    private $solicitudIdsolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitud_investigador_idinves", type="integer", nullable=false)
     */
    private $solicitudInvestigadorIdinves;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=true)
     */
    private $fechaFinal;


}

