<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="SOLICITUD", indexes={@ORM\Index(name="i_solicitud_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Solicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDSOLICITUD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SOLICITUD_IDSOLICITUD_seq", allocationSize=1, initialValue=1)
     */
    private $idsolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="INVESTIGADOR_IDINVESTIGADOR", type="integer", nullable=false)
     */
    private $investigadorIdinvestigador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_DOCUMENTO", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESERVADO", type="integer", nullable=false)
     */
    private $reservado;


}

