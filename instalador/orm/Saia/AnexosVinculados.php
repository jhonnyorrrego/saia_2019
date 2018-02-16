<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosVinculados
 *
 * @ORM\Table(name="anexos_vinculados")
 * @ORM\Entity
 */
class AnexosVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idanexosVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_origen", type="integer", nullable=false)
     */
    private $anexosOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_destino", type="integer", nullable=false)
     */
    private $anexosDestino;

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
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=true)
     */
    private $observaciones;



    /**
     * Get idanexosVinculados
     *
     * @return integer
     */
    public function getIdanexosVinculados()
    {
        return $this->idanexosVinculados;
    }

    /**
     * Set anexosOrigen
     *
     * @param integer $anexosOrigen
     *
     * @return AnexosVinculados
     */
    public function setAnexosOrigen($anexosOrigen)
    {
        $this->anexosOrigen = $anexosOrigen;

        return $this;
    }

    /**
     * Get anexosOrigen
     *
     * @return integer
     */
    public function getAnexosOrigen()
    {
        return $this->anexosOrigen;
    }

    /**
     * Set anexosDestino
     *
     * @param integer $anexosDestino
     *
     * @return AnexosVinculados
     */
    public function setAnexosDestino($anexosDestino)
    {
        $this->anexosDestino = $anexosDestino;

        return $this;
    }

    /**
     * Get anexosDestino
     *
     * @return integer
     */
    public function getAnexosDestino()
    {
        return $this->anexosDestino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return AnexosVinculados
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
     * @return AnexosVinculados
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return AnexosVinculados
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
