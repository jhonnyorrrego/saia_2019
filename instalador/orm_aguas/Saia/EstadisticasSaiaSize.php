<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadisticasSaiaSize
 *
 * @ORM\Table(name="ESTADISTICAS_SAIA_SIZE")
 * @ORM\Entity
 */
class EstadisticasSaiaSize
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDESTADISTICAS_SAIA_SIZE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ESTADISTICAS_SAIA_SIZE_IDESTAD", allocationSize=1, initialValue=1)
     */
    private $idestadisticasSaiaSize;

    /**
     * @var string
     *
     * @ORM\Column(name="TAMANIO", type="string", length=255, nullable=false)
     */
    private $tamanio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="string", length=255, nullable=false)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REGISTRO", type="date", nullable=false)
     */
    private $fechaRegistro;


}

