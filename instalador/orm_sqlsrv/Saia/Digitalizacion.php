<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Digitalizacion
 *
 * @ORM\Table(name="digitalizacion", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Digitalizacion
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
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
