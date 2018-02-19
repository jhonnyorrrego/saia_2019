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
     * @ORM\Column(name="INSTANCIA_IDPASO_INSTANCIA", type="integer", nullable=true)
     */
    private $instanciaIdpasoInstancia;

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

