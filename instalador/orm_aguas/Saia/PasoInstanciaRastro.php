<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaRastro
 *
 * @ORM\Table(name="PASO_INSTANCIA_RASTRO")
 * @ORM\Entity
 */
class PasoInstanciaRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_INSTANCIA_RASTRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_INSTANCIA_RASTRO_IDPASO_I", allocationSize=1, initialValue=1)
     */
    private $idpasoInstanciaRastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="INSTANCIA_IDPASO_INSTANCIA", type="integer", nullable=false)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_ORIGINAL", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_FINAL", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CAMBIO", type="date", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDPASO_DOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="INST_IDPASO_INST", type="integer", nullable=true)
     */
    private $instIdpasoInst;


}
