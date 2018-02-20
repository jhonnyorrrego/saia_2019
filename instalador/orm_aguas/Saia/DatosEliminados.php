<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEliminados
 *
 * @ORM\Table(name="DATOS_ELIMINADOS")
 * @ORM\Entity
 */
class DatosEliminados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDATOS_ELIMINADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DATOS_ELIMINADOS_IDDATOS_ELIMI", allocationSize=1, initialValue=1)
     */
    private $iddatosEliminados;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA", type="string", length=255, nullable=false)
     */
    private $tabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDTABLA", type="integer", nullable=true)
     */
    private $idtabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION", type="text", nullable=false)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;


}

