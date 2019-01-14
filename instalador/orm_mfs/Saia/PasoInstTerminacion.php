<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstTerminacion
 *
 * @ORM\Table(name="paso_inst_terminacion")
 * @ORM\Entity
 */
class PasoInstTerminacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_inst_terminacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoInstTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="instancia_idpaso_instancia", type="integer", nullable=false)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_justificacion", type="datetime", nullable=false)
     */
    private $fechaJustificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;


}

