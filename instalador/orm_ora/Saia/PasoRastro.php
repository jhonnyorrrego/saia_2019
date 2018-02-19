<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoRastro
 *
 * @ORM\Table(name="PASO_RASTRO")
 * @ORM\Entity
 */
class PasoRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_RASTRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_RASTRO_IDPASO_RASTRO_seq", allocationSize=1, initialValue=1)
     */
    private $idpasoRastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDPASO_DOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_ORIGINAL", type="integer", nullable=true)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_FINAL", type="integer", nullable=true)
     */
    private $estadoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CAMBIO", type="date", nullable=true)
     */
    private $fechaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}

