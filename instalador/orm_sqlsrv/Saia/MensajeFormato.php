<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * MensajeFormato
 *
 * @ORM\Table(name="mensaje_formato")
 * @ORM\Entity
 */
class MensajeFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmensaje_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmensajeFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_mensaje", type="string", length=255, nullable=false)
     */
    private $campoMensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_formato", type="string", length=255, nullable=false)
     */
    private $campoFormato;



    /**
     * Get idmensajeFormato
     *
     * @return integer
     */
    public function getIdmensajeFormato()
    {
        return $this->idmensajeFormato;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return MensajeFormato
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set campoMensaje
     *
     * @param string $campoMensaje
     *
     * @return MensajeFormato
     */
    public function setCampoMensaje($campoMensaje)
    {
        $this->campoMensaje = $campoMensaje;

        return $this;
    }

    /**
     * Get campoMensaje
     *
     * @return string
     */
    public function getCampoMensaje()
    {
        return $this->campoMensaje;
    }

    /**
     * Set campoFormato
     *
     * @param string $campoFormato
     *
     * @return MensajeFormato
     */
    public function setCampoFormato($campoFormato)
    {
        $this->campoFormato = $campoFormato;

        return $this;
    }

    /**
     * Get campoFormato
     *
     * @return string
     */
    public function getCampoFormato()
    {
        return $this->campoFormato;
    }
}
