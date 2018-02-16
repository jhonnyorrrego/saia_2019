<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventoDespacho
 *
 * @ORM\Table(name="evento_despacho", indexes={@ORM\Index(name="i_evt_desp_doc_iddocumento", columns={"idft_destino_radicacion"})})
 * @ORM\Entity
 */
class EventoDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddigitalizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddigitalizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="idft_destino_radicacion", type="string", length=255, nullable=false)
     */
    private $idftDestinoRadicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=true)
     */
    private $justificacion;



    /**
     * Get iddigitalizacion
     *
     * @return integer
     */
    public function getIddigitalizacion()
    {
        return $this->iddigitalizacion;
    }

    /**
     * Set idftDestinoRadicacion
     *
     * @param string $idftDestinoRadicacion
     *
     * @return EventoDespacho
     */
    public function setIdftDestinoRadicacion($idftDestinoRadicacion)
    {
        $this->idftDestinoRadicacion = $idftDestinoRadicacion;

        return $this;
    }

    /**
     * Get idftDestinoRadicacion
     *
     * @return string
     */
    public function getIdftDestinoRadicacion()
    {
        return $this->idftDestinoRadicacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EventoDespacho
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
     * Set accion
     *
     * @param string $accion
     *
     * @return EventoDespacho
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set funcionario
     *
     * @param string $funcionario
     *
     * @return EventoDespacho
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return string
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return EventoDespacho
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }
}
