<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListadoTareas
 *
 * @ORM\Table(name="listado_tareas", indexes={@ORM\Index(name="i_listado_tare_creador_list", columns={"creador_lista"})})
 * @ORM\Entity
 */
class ListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlistado_tareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idlistadoTareas;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_lista", type="string", length=255, nullable=false)
     */
    private $nombreLista;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_lista", type="text", nullable=true)
     */
    private $descripcionLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="creador_lista", type="integer", nullable=false)
     */
    private $creadorLista;

    /**
     * @var string
     *
     * @ORM\Column(name="cliente_proyecto", type="string", length=255, nullable=true)
     */
    private $clienteProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="macro_proceso", type="string", length=255, nullable=true)
     */
    private $macroProceso;


}