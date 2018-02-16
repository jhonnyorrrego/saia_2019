<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaginaVinculados
 *
 * @ORM\Table(name="pagina_vinculados")
 * @ORM\Entity
 */
class PaginaVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpagina_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpaginaVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_origen", type="integer", nullable=false)
     */
    private $paginaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_destino", type="integer", nullable=false)
     */
    private $paginaDestino;

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
     * Get idpaginaVinculados
     *
     * @return integer
     */
    public function getIdpaginaVinculados()
    {
        return $this->idpaginaVinculados;
    }

    /**
     * Set paginaOrigen
     *
     * @param integer $paginaOrigen
     *
     * @return PaginaVinculados
     */
    public function setPaginaOrigen($paginaOrigen)
    {
        $this->paginaOrigen = $paginaOrigen;

        return $this;
    }

    /**
     * Get paginaOrigen
     *
     * @return integer
     */
    public function getPaginaOrigen()
    {
        return $this->paginaOrigen;
    }

    /**
     * Set paginaDestino
     *
     * @param integer $paginaDestino
     *
     * @return PaginaVinculados
     */
    public function setPaginaDestino($paginaDestino)
    {
        $this->paginaDestino = $paginaDestino;

        return $this;
    }

    /**
     * Get paginaDestino
     *
     * @return integer
     */
    public function getPaginaDestino()
    {
        return $this->paginaDestino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PaginaVinculados
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
     * @return PaginaVinculados
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
     * @return PaginaVinculados
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
