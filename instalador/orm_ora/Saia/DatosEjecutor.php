<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEjecutor
 *
 * @ORM\Table(name="DATOS_EJECUTOR", indexes={@ORM\Index(name="ejecutor_id_index", columns={"EJECUTOR_IDEJECUTOR"})})
 * @ORM\Entity
 */
class DatosEjecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDATOS_EJECUTOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DATOS_EJECUTOR_IDDATOS_EJECUTO", allocationSize=1, initialValue=1)
     */
    private $iddatosEjecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="EJECUTOR_IDEJECUTOR", type="integer", nullable=true)
     */
    private $ejecutorIdejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD", type="string", length=255, nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="TITULO", type="string", length=50, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="EMPRESA", type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=255, nullable=true)
     */
    private $codigo;


}
