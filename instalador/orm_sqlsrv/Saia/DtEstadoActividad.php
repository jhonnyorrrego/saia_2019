<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DtEstadoActividad
 *
 * @ORM\Table(name="dt_estado_actividad")
 * @ORM\Entity
 */
class DtEstadoActividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddt_estado_actividad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddtEstadoActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

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
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;


}

