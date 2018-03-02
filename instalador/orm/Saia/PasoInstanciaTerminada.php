<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaTerminada
 *
 * @ORM\Table(name="paso_instancia_terminada", indexes={@ORM\Index(name="i_paso_instancia_terminada_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoInstanciaTerminada
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
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=false)
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
     * @ORM\Column(name="tipo_terminacion", type="integer", nullable=false)
     */
    private $tipoTerminacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_actividad", type="integer", nullable=false)
     */
    private $estadoActividad = '1';



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
     * @return PasoInstanciaTerminada
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PasoInstanciaTerminada
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

    /**
     * Set responsable
     *
     * @param integer $responsable
     *
     * @return PasoInstanciaTerminada
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return integer
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
     * @return PasoInstanciaTerminada
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
     * Set tipoTerminacion
     *
     * @param integer $tipoTerminacion
     *
     * @return PasoInstanciaTerminada
     */
    public function setTipoTerminacion($tipoTerminacion)
    {
        $this->tipoTerminacion = $tipoTerminacion;

        return $this;
    }

    /**
     * Get tipoTerminacion
     *
     * @return integer
     */
    public function getTipoTerminacion()
    {
        return $this->tipoTerminacion;
    }

    /**
     * Set estadoActividad
     *
     * @param integer $estadoActividad
     *
     * @return PasoInstanciaTerminada
     */
    public function setEstadoActividad($estadoActividad)
    {
        $this->estadoActividad = $estadoActividad;

        return $this;
    }

    /**
     * Get estadoActividad
     *
     * @return integer
     */
    public function getEstadoActividad()
    {
        return $this->estadoActividad;
    }
}
