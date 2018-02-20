<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListadoTareas
 *
 * @ORM\Table(name="LISTADO_TAREAS", indexes={@ORM\Index(name="i_listado_tare_creador_list", columns={"CREADOR_LISTA"})})
 * @ORM\Entity
 */
class ListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDLISTADO_TAREAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="LISTADO_TAREAS_IDLISTADO_TAREA", allocationSize=1, initialValue=1)
     */
    private $idlistadoTareas;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_LISTA", type="string", length=255, nullable=false)
     */
    private $nombreLista;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_LISTA", type="text", nullable=true)
     */
    private $descripcionLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="CREADOR_LISTA", type="integer", nullable=false)
     */
    private $creadorLista;

    /**
     * @var string
     *
     * @ORM\Column(name="CLIENTE_PROYECTO", type="string", length=255, nullable=true)
     */
    private $clienteProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="MACRO_PROCESO", type="string", length=255, nullable=true)
     */
    private $macroProceso;


}
