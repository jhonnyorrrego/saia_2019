<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionNotas
 *
 * @ORM\Table(name="version_notas")
 * @ORM\Entity
 */
class VersionNotas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_notas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idversionNotas;

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
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=false)
     */
    private $fkIdversionDocumento;


}
