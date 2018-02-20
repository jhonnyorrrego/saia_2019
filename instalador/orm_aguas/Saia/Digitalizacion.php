<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Digitalizacion
 *
 * @ORM\Table(name="digitalizacion", indexes={@ORM\Index(name="i_digitalizacion_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_digitalizaci_funcionario", columns={"funcionario"})})
 * @ORM\Entity
 */
class Digitalizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddigitalizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="fecha", type="date", nullable=false)
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
     * @ORM\Column(name="justificacion", type="text", nullable=true)
     */
    private $justificacion;


}
