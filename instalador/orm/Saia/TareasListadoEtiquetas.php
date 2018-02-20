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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';



    /**
     * Get idtareasListadoEtiquetas
     *
     * @return integer
     */
    public function getIdtareasListadoEtiquetas()
    {
        return $this->idtareasListadoEtiquetas;
    }

    /**
     * Set etiquetaIdetiqueta
     *
     * @param integer $etiquetaIdetiqueta
     *
     * @return TareasListadoEtiquetas
     */
    public function setEtiquetaIdetiqueta($etiquetaIdetiqueta)
    {
        $this->etiquetaIdetiqueta = $etiquetaIdetiqueta;

        return $this;
    }

    /**
     * Get etiquetaIdetiqueta
     *
     * @return integer
     */
    public function getEtiquetaIdetiqueta()
    {
        return $this->etiquetaIdetiqueta;
    }

    /**
     * Set tareasListadoFk
     *
     * @param integer $tareasListadoFk
     *
     * @return TareasListadoEtiquetas
     */
    public function setTareasListadoFk($tareasListadoFk)
    {
        $this->tareasListadoFk = $tareasListadoFk;

        return $this;
    }

    /**
     * Get tareasListadoFk
     *
     * @return integer
     */
    public function getTareasListadoFk()
    {
        return $this->tareasListadoFk;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TareasListadoEtiquetas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
