<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEtiquetas
 *
 * @ORM\Table(name="tareas_listado_etiquetas", indexes={@ORM\Index(name="etiqueta_idetiqueta", columns={"etiqueta_idetiqueta"}), @ORM\Index(name="documento_iddocumento", columns={"tareas_listado_fk"})})
 * @ORM\Entity
 */
class TareasListadoEtiquetas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_etiquetas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';


}

