<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEjecutor
 *
 * @ORM\Table(name="datos_ejecutor")
 * @ORM\Entity
 */
class DatosEjecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddatos_ejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddatosEjecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor_idejecutor", type="integer", nullable=false)
     */
    private $ejecutorIdejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ciudad", type="integer", nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=50, nullable=true)
     */
    private $titulo = 'Se&ntilde;or';

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;


}
