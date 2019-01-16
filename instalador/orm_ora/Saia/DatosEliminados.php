<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEliminados
 *
 * @ORM\Table(name="datos_eliminados")
 * @ORM\Entity
 */
class DatosEliminados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddatos_eliminados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="DATOS_ELIMINADOS_IDDATOS_ELIMI", allocationSize=1, initialValue=1)
     */
    private $iddatosEliminados;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255, nullable=false)
     */
    private $tabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="idtabla", type="integer", nullable=true)
     */
    private $idtabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario", type="integer", nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", nullable=false)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;


}

