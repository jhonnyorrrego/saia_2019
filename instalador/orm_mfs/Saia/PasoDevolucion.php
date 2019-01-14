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


}

