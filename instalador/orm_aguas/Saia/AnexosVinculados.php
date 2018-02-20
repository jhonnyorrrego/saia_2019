<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosVinculados
 *
 * @ORM\Table(name="ANEXOS_VINCULADOS", indexes={@ORM\Index(name="i_anexos_vincu_anexos_desti", columns={"ANEXOS_DESTINO"}), @ORM\Index(name="i_anexos_vincu_anexos_orige", columns={"ANEXOS_ORIGEN"})})
 * @ORM\Entity
 */
class AnexosVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDANEXOS_VINCULADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_VINCULADOS_IDANEXOS_VIN", allocationSize=1, initialValue=1)
     */
    private $idanexosVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANEXOS_ORIGEN", type="integer", nullable=false)
     */
    private $anexosOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANEXOS_DESTINO", type="integer", nullable=false)
     */
    private $anexosDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
