<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Error
 *
 * @ORM\Table(name="error")
 * @ORM\Entity
 */
class Error
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iderror", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ERROR_IDERROR_seq", allocationSize=1, initialValue=1)
     */
    private $iderror;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_error", type="text", nullable=false)
     */
    private $codigoError;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
