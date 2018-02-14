<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDevolucion
 *
 * @ORM\Table(name="paso_devolucion")
 * @ORM\Entity
 */
class PasoDevolucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_devolucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoDevolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_antiguo_pendiente", type="integer", nullable=false)
     */
    private $idpasoAntiguoPendiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_nuevo_pendiente", type="integer", nullable=false)
     */
    private $idpasoNuevoPendiente;



    /**
     * Get idpasoDevolucion
     *
     * @return integer
     */
    public function getIdpasoDevolucion()
    {
        return $this->idpasoDevolucion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PasoDevolucion
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return PasoDevolucion
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PasoDevolucion
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
     * Set idpasoAntiguoPendiente
     *
     * @param integer $idpasoAntiguoPendiente
     *
     * @return PasoDevolucion
     */
    public function setIdpasoAntiguoPendiente($idpasoAntiguoPendiente)
    {
        $this->idpasoAntiguoPendiente = $idpasoAntiguoPendiente;

        return $this;
    }

    /**
     * Get idpasoAntiguoPendiente
     *
     * @return integer
     */
    public function getIdpasoAntiguoPendiente()
    {
        return $this->idpasoAntiguoPendiente;
    }

    /**
     * Set idpasoNuevoPendiente
     *
     * @param integer $idpasoNuevoPendiente
     *
     * @return PasoDevolucion
     */
    public function setIdpasoNuevoPendiente($idpasoNuevoPendiente)
    {
        $this->idpasoNuevoPendiente = $idpasoNuevoPendiente;

        return $this;
    }

    /**
     * Get idpasoNuevoPendiente
     *
     * @return integer
     */
    public function getIdpasoNuevoPendiente()
    {
        return $this->idpasoNuevoPendiente;
    }
}
