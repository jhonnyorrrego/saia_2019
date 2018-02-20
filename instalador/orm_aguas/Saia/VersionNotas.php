<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionNotas
 *
 * @ORM\Table(name="VERSION_NOTAS")
 * @ORM\Entity
 */
class VersionNotas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDVERSION_NOTAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VERSION_NOTAS_IDVERSION_NOTAS_", allocationSize=1, initialValue=1)
     */
    private $idversionNotas;

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
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDVERSION_DOCUMENTO", type="integer", nullable=false)
     */
    private $fkIdversionDocumento;


}
