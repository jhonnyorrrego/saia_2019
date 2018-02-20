<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEtiquetas
 *
 * @ORM\Table(name="TAREAS_LISTADO_ETIQUETAS", indexes={@ORM\Index(name="i_tareas_lista_tareas_lista", columns={"TAREAS_LISTADO_FK"})})
 * @ORM\Entity
 */
class TareasListadoEtiquetas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_ETIQUETAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_ETIQUETAS_IDTAR", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoEtiquetas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ETIQUETA_IDETIQUETA", type="integer", nullable=false)
     */
    private $etiquetaIdetiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREAS_LISTADO_FK", type="integer", nullable=false)
     */
    private $tareasListadoFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
