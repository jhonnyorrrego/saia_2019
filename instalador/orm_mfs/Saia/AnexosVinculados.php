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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

