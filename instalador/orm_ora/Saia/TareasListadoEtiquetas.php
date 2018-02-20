<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEtiquetas
 *
 * @ORM\Table(name="tareas_listado_etiquetas", indexes={@ORM\Index(name="i_tareas_lista_tareas_lista", columns={"tareas_listado_fk"})})
 * @ORM\Entity
 */
class TareasListadoEtiquetas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_etiquetas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListadoEtiquetas;

    /**
     * @var integer
     *
     * @ORM\Column(name="etiqueta_idetiqueta", type="integer", nullable=false)
     */
    private $etiquetaIdetiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas_listado_fk", type="integer", nullable=false)
     */
    private $tareasListadoFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
