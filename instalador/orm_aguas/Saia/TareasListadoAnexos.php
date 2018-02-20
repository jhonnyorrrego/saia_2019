<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoAnexos
 *
 * @ORM\Table(name="TAREAS_LISTADO_ANEXOS")
 * @ORM\Entity
 */
class TareasListadoAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_ANEXOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_ANEXOS_IDTAREAS", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=500, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_HORA", type="date", nullable=false)
     */
    private $fechaHora;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;


}
