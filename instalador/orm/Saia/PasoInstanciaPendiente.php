<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaPendiente
 *
 * @ORM\Table(name="paso_instancia_pendiente", indexes={@ORM\Index(name="i_paso_inst_doc_iddoc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoInstanciaPendiente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_instancia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idpaso_actividad", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="text", length=65535, nullable=false)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;



    /**
     * Get idpasoInstancia
     *
     * @return integer
     */
    public function getIdpasoInstancia()
    {
        return $this->idpasoInstancia;
    }

    /**
     * Set actividadIdpasoActividad
     *
     * @param integer $actividadIdpasoActividad
     *
     * @return PasoInstanciaPendiente
     */
    public function setActividadIdpasoActividad($actividadIdpasoActividad)
    {
        $this->actividadIdpasoActividad = $actividadIdpasoActividad;

        return $this;
    }

    /**
     * Get actividadIdpasoActividad
     *
     * @return integer
     */
    public function getActividadIdpasoActividad()
    {
        return $this->actividadIdpasoActividad;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return PasoInstanciaPendiente
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PasoInstanciaPendiente
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

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PasoInstanciaPendiente
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }
}
