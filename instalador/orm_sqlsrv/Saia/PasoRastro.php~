<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoRastro
 *
 * @ORM\Table(name="paso_rastro")
 * @ORM\Entity
 */
class PasoRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_rastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoRastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_original", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_final", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="datetime", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;


}

