<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventoDespacho
 *
 * @ORM\Table(name="evento_despacho", indexes={@ORM\Index(name="documento_iddocumento", columns={"idft_destino_radicacion"})})
 * @ORM\Entity
 */
class EventoDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddigitalizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddigitalizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="idft_destino_radicacion", type="string", length=255, nullable=false)
     */
    private $idftDestinoRadicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=true)
     */
    private $justificacion;


}
