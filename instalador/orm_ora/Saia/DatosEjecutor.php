<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEjecutor
 *
 * @ORM\Table(name="datos_ejecutor", indexes={@ORM\Index(name="i_datos_ejecut_ejecutor_ide", columns={"ejecutor_idejecutor"}), @ORM\Index(name="i_datos_ejecut_ciudad", columns={"ciudad"})})
 * @ORM\Entity
 */
class DatosEjecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddatos_ejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddatosEjecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor_idejecutor", type="integer", nullable=true)
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

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
