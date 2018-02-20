<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Error
 *
 * @ORM\Table(name="ERROR", indexes={@ORM\Index(name="i_error_codigo_err_ctx", columns={"CODIGO_ERROR"})})
 * @ORM\Entity
 */
class Error
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDERROR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ERROR_IDERROR_seq", allocationSize=1, initialValue=1)
     */
    private $iderror;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_ERROR", type="text", nullable=false)
     */
    private $codigoError;

    /**
     * @var string
     *
     * @ORM\Column(name="ARCHIVO", type="string", length=255, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=false)
     */
    private $origen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
